<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use App\Models\JobOrder;
use App\Models\StockItem;
use App\Models\JobOrderItem;
use Illuminate\Http\Request;
use App\Models\RawMaterialRequest;
use App\Models\RawMaterialRequestItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RawMaterialRequestController extends Controller
{

    public function generateNextNumber()
    {
        $count  = RawMaterialRequest::get()->count();
        return "RMR" . sprintf('%06d', $count + 1);
    }

    public function index()
    {
        $list = RawMaterialRequest::with(['items.job_order_item.stock_item'])->get();
        return view('pages.RawMaterialRequest.index', compact('list'));
    }

    public function create()
    {
        session(['rmr.items' => []]);
        $employees = Employee::get();
        $next_number = $this->generateNextNumber();
        $job_orders =  JobOrder::with(['plant','items.stock_item','items' => function ($item) {
            return $item->where('approval_status', 'approved');
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'approved');
            })
            ->whereDoesntHave('raw_mat_request')
            ->get();
        $stock_items = StockItem::with('stocks')->get();
        return view('pages.RawMaterialRequest.create', compact('employees', 'next_number', 'job_orders', 'stock_items'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'rmr_no' => 'required',
            'req_date' => 'required',
            'requested_by' => 'required',
            'required_date' => 'required',
            'justification' => 'required',
            'job_order_no' => 'required',
            'plant' => 'required',
        ]);
        $items = session('rmr.items') ?? [];
        if (count($items) == 0) {
            throw ValidationException::withMessages(['items' => 'please add raw material item']);
        }
        try {
            DB::beginTransaction();

            $data = $request->all();

            $isRmrExist = RawMaterialRequest::where('rmr_no', $request->rmr_no)->first();
            if ($isRmrExist) {
                $data['rmr_no'] = $this->generateNextNumber();
            }

            $rmr = new RawMaterialRequest;
            $rmr->rmr_no = $data['rmr_no'];
            $rmr->req_date = $request->req_date;
            $rmr->requested_by = $request->requested_by;
            $rmr->required_date = $request->required_date;
            $rmr->justification = $request->justification;
            $rmr->job_order_no = $request->job_order_no;
            $rmr->plant_id = $request->plant;
            $rmr->created_by = request()->user()->id;
            $rmr->save();

            foreach ($items as $key => $item) {
                $rmr_item = new RawMaterialRequestItem;
                $rmr_item->rmr_no = $rmr->id;
                $rmr_item->jo_stock_no = $item['jo_id'];
                $rmr_item->raw_material_stock_no = $item['raw_material_stock_id'];
                $rmr_item->req_qty = $item['req_qty'];
                $rmr_item->req_weight = $item['req_weight'];
                $rmr_item->save();
            }
            DB::commit();
            flash()->success('Raw Material Request Created successfully');
            return redirect()->route('raw_material_request.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e);
        }
    }

    public function addItem(Request $request)
    {

        $this->validate($request, [
            'job_order_stock_id' => 'required',
            'stock_item_id' => 'required',
            'item_qty' => 'required',
            'item_weight' => 'required',
        ], [
            "job_order_stock_id.required" => 'The job order item field is required',
            "stock_item_id.required" => 'The stock item field is required',
            "item_qty.required" => 'The stock item quantity field is required',
            "item_weight.required" => 'The stock item weight field is required',
        ]);

        $items = session('rmr.items') ?? [];

        $job_order_item = JobOrderItem::find($request->job_order_stock_id);
        $stock_item_job_order = StockItem::find($job_order_item->stock_id);
        $stock_item = StockItem::find($request->stock_item_id);

        $items[] = [
            'jo_id' => $request->job_order_stock_id,
            'jo_stock_no' => $stock_item_job_order->stock_number,
            'jo_description' => $stock_item_job_order->description,
            'raw_material_stock_id' => $request->stock_item_id,
            'raw_material_stock_no' => $stock_item->stock_number,
            'raw_material_description' => $stock_item->description,
            'req_qty' => $request->item_qty,
            'req_weight' => $request->item_weight,
        ];

        session(['rmr.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Added',
        ];
    }

    public function deleteItem(Request $request)
    {
        $items =  session('rmr.items') ?? [];
        unset($items[$request->index]);
        session(['rmr.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }

    public function viewCartTable()
    {
        $items =  session('rmr.items') ?? [];
        return view('pages.RawMaterialRequest.cart_table', compact('items'));
    }

    public function getStockItem(Request $request)
    {
        $stockitems = StockItem::with(['stocks.warehouse'])->find($request->item_id);
        return $stockitems;
    }
}
