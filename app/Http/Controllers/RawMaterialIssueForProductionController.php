<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\JobOrder;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\RawMaterialIssue;
use App\Models\RawMaterialRequest;
use App\Models\SemiProductionItem;
use Illuminate\Support\Facades\DB;
use App\Models\RawMaterialIssueItem;
use App\Services\StockLogService;
use Illuminate\Validation\ValidationException;


class RawMaterialIssueForProductionController extends Controller
{

    public function generateNextNumber()
    {
        $count  = RawMaterialIssue::get()->count();
        return "RMI" . sprintf('%06d', $count + 1);
    }

    public function index(Request $request)
    {
        $list = RawMaterialIssueItem::with(['raw_material_issue', 'raw_material_request_item'])
        ->when($request->search, function($q) use ($request){
          $q->where('semi_product_serial_no', 'like', '%' . $request->search . '%')
          ->orWhere(function ($qr) use ($request){
              return $qr->whereHas('raw_material_issue', function ($issue) use ($request){
              $issue->where('rmi_no', 'like', '%' . $request->search . '%');
          });
            })
            ->orWhere(function ($query) use ($request){
              return $query->whereHas('raw_material_request_item.stock_item', function ($reqitem) use ($request){
                  $reqitem->where('stock_number', 'like', '%' . $request->search . '%');
  });
});

})

        ->latest()
        ->paginate(25);
        return view('pages.RawMaterialIssueForProduction.index', compact('list'));

        // $list = RawMaterialIssueItem::get();
        // return view('pages.RawMaterialIssueForProduction.index', compact('list'));
    }

    public function create()
    {
        session(['rmi.items' => []]);
        $job_orders =  JobOrder::with(['items' => function ($item) {
            return $item->where('approval_status', 'approved');
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'approved');
            })
            ->get();
        $rmr_list = RawMaterialRequest::with(['items.issued', 'requestedBy', 'plant', 'job_order', 'items.stock_item', 'items.approval'])
            ->whereHas('items.approval')
            ->whereDoesntHave('items.issued')
            ->get();
        $warehouses = Warehouse::get();
        $next_number = $this->generateNextNumber();
        return view('pages.RawMaterialIssueForProduction.create', compact('warehouses', 'next_number', 'rmr_list'));
    }

    public function store(Request $request)
    {
        $stockLog = new StockLogService;

        $this->validate($request, [
            'date' => 'required',
            'rmi_no' => 'required',
            'rmr_no' => 'required',
            'warehouse_code' => 'required',
        ]);
        $items = session('rmi.items') ?? [];

        if (count($items) == 0) {
            throw ValidationException::withMessages(['items' => 'please add raw material item']);
        }

        try {
            DB::beginTransaction();

            $data = $request->all();

            $isRmiExist = RawMaterialIssue::where('rmi_no', $request->rmi_no)->first();
            if ($isRmiExist) {
                $data['rmi_no'] = $this->generateNextNumber();
            }

            $rmi = new RawMaterialIssue;
            $rmi->date = $request->date;
            $rmi->rmi_no = $data['rmi_no'];
            $rmi->rmr_no = $request->rmr_no;
            $rmi->total_issued_qty = collect($items)->sum('semi_product_qty');
            $rmi->total_issued_weight = collect($items)->sum('semi_product_weight');
            $rmi->warehouse_id = $request->warehouse_code;
            $rmi->created_by = request()->user()->id;
            $rmi->save();


            foreach ($items as $key => $item) {
                $rmi_item = new RawMaterialIssueItem;
                $rmi_item->rmi_no = $data['rmi_no'];
                $rmi_item->issued_item_no = $item['issued_item_no'];
                $rmi_item->semi_product_serial_no = $item['semi_product_serial_no'];
                $rmi_item->semi_product_qty = $item['semi_product_qty'];
                $rmi_item->semi_product_weight = $item['semi_product_weight'];
                $rmi_item->remarks = $item['remarks'];
                $rmi_item->save();



                $stockLog->createLog(
                    StockLogService::$RAWMATERIAL_ISSUE,
                    $request->warehouse_code,
                    $item['issued_item_no'],
                    collect($items)->sum('semi_product_qty'),
                    StockLogService::$DEDUCT,
                    $rmi->rmi_no,
                    $request->user()->id,
                    null,
                );

                // reduce Stock
                $semiProduct = SemiProductionItem::find($item['semi_product_item_id']);
                $stock = Stock::where('stock_item_id',  $semiProduct->semi_pro_stock_no)
                    ->where('warehouse_id', $semiProduct->semi_production->warehouse_id)
                    ->first();
                if ($stock) {
                    $stock->qty = $stock->qty - collect($items)->sum('semi_product_qty');
                    $stock->save();
                }
            }

            DB::commit();
            flash()->success("Raw Material Issue For Production created successfully!");
            return redirect()->route('rawmaterialissueforproduction.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e);
            flash()->error($e->getMessage());
            redirect()->back()->withInput();
        }
    }


    public function getSemiProductSerials(Request $request)
    {
        $list = SemiProductionItem::with(['semi_product_stock_item', 'raw_material_issue_item'])
            ->where('semi_pro_stock_no', $request->raw_material_stock_no)
            ->whereDoesntHave('raw_material_issue_item')
            ->get();
        return $list;
    }

    public function addItem(Request $request)
    {

        $this->validate($request, [
            'req_item_id' => 'required',
            'semi_product_item_id' => 'required',
            'issue_qty' => 'required',
            'issue_weight' => 'required',
        ], [
            "req_item_id.required" => 'The request item field is required',
            "semi_product_item_id.required" => 'The semi product serial number field is required',
            "issue_qty.required" => 'The qty field is required',
            "issue_weight.required" => 'The weight field is required',
        ]);

        $items = session('rmi.items') ?? [];
        $result = collect($items)->where('semi_pro_serial_no', $request->semi_pro_serial_no)->first();
        if ($result != null) {
            throw ValidationException::withMessages(['items' => "The items already exist"]);
        }
        $semiProduct = SemiProductionItem::find($request->semi_product_item_id);

        $items[] = [
            'semi_pro_serial_no' => $request->semi_pro_serial_no,
            'semi_product_item_id' => $request->semi_product_item_id,
            'req_item_stock_number' => $request->req_item_stock_number,
            'req_item_qty' => $request->req_item_qty,
            'req_item_weight' => $request->req_item_weight,
            'issued_item_no' => $request->req_item_id,
            'semi_product_serial_no' => $semiProduct->semi_pro_serial_no,
            'semi_product_qty' => $request->issue_qty,
            'semi_product_weight' => $request->issue_weight,
            'remarks' => $request->issue_remark,
        ];

        session(['rmi.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Added',
        ];
    }

    public function deleteItem(Request $request)
    {
        $items =  session('rmi.items') ?? [];
        $result = collect($items)->filter(function ($item) use ($request) {
            return $item['semi_product_item_id'] != $request->index;
        });

        session(['rmi.items' => $result->toArray()]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }

    public function viewCartTable()
    {
        $items =  session('rmi.items') ?? [];
        return view('pages.RawMaterialIssueForProduction.cart_table', compact('items'));
    }
}
