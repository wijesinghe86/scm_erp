<?php

namespace App\Http\Controllers;
use PDF;
use Exception;
use App\Models\Stock;
use App\Models\Employee;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use App\Models\FleetRegistration;
use App\Services\StockLogService;
use Illuminate\Support\Facades\DB;
use App\Models\StockLocationChange;
use Illuminate\Support\Facades\Auth;
use App\Models\StockLocationChangeItem;
use App\Models\StockLocationChangeIssued;

use App\Models\StockLocationChangeReceived;
use Illuminate\Validation\ValidationException;

class StockLocationChangeController extends Controller
{

    public function generateNextNumber()
    {
        $count  = StockLocationChange::get()->count();
        return "SLC" . sprintf('%06d', $count + 1);
    }

    public function index()
    {
        $stock_location_changes =  StockLocationChange::get();
        return view('pages.StockLocationChange.index', compact('stock_location_changes'));
    }

    public function create()
    {
        $stockItems = StockItem::with('stocks.warehouse')->get();
        $warehouses = Warehouse::get();
        $employees = Employee::get();
        $fleets = FleetRegistration::get();

        $next_number = $this->generateNextNumber();
        return view('pages.StockLocationChange.create', compact('warehouses', 'stockItems', 'employees', 'fleets', 'next_number'));
    }

    public function store(Request $request)
    {
        $items = session('slc.items') ?? [];
        // logger($items);

        $this->validate($request, [
            'slc_date' => 'required|date',
            //'issued_by' => 'required',
            'issued_date' => 'required',
            'from_location' => 'required',
            'to_location' => 'required',
        ]);

        if (count($items) == 0) {
            throw ValidationException::withMessages(['items' => 'please add products']);
        }

        try {
            DB::beginTransaction();
            $slc = new StockLocationChange();
            $slc->slc_number = $request->slc_number;
            $slc->slc_date = $request->slc_date;
            $slc->issued_by = $request->issued_by;
            $slc->issued_date = $request->issued_date;
            $slc->from_location = $request->from_location;
            $slc->to_location = $request->to_location;
            $slc->created_by = request()->user()->id;
            $slc->remarks = $request->remarks;
            $slc->fleet_id = $request->fleet_id;
            $slc->delivered_by = $request->delivered_by;
            $slc->save();

            foreach ($items as $key => $item) {
                logger($item);
                $slc_item = new StockLocationChangeItem();
                $slc_item->slc_id = $slc->id;
                $slc_item->from_location = $slc->from_location;
                $slc_item->to_location = $slc->to_location;
                $slc_item->stock_item_id = $item['stock_item_id'];
                $slc_item->qty = $item['issue_qty'];
                $slc_item->save();
            }

            DB::commit();
            session(['slc.items' => []]);
            flash()->success('Stock Location Change created successfully!');
            return redirect()->route('stocklocationchange.index');
        }
        catch (Exception $error) {
            logger($error);
            $response['alert-danger'] = $error->getMessage();
        }
    }

    public function addItemToTable(Request $request)
    {
        $this->validate(
            $request,
            [
                'stock_item_id' => 'required',
                'issue_qty' => 'required',
            ],
            [
                'stock_item_id.required' => 'The description field is required',
                'issue_qty.required' => 'The issued qty field is required',
            ]
        );

        // $slc_items = StockLocationChangeItem::get();
        // $stock = Stock::where('stock_item_id', $slc_items->stock_item_id)->where('warehouse_id', $slc_items->from_location)->first();
        // if($request->issue_qty > $stock->qty){
        // flash()->danger('Exceeded');
        // $request->issue_qty == "";
        // logger($slc_items);
// }

        $items =  session('slc.items') ?? [];

        $is_exist = collect($items)->filter(function ($item) use ($request) {
            return $item['stock_item_id'] == $request->stock_item_id;
        });

        if (count($is_exist) > 0) {
            throw ValidationException::withMessages(['items' => '"Item Already added"']);
        }

        $stock_item = StockItem::find($request->stock_item_id);

        $items[] = [
            'stock_number' => $stock_item->stock_number,
            'stock_item_id' => $stock_item->id,
            'description' => $stock_item->description,
            'uom' => $stock_item->unit,
            'issue_qty' => $request->issue_qty,
        ];

        session(['slc.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Added',
        ];
    }

    public function removeItemFromTable(Request $request)
    {
        $items =  session('slc.items') ?? [];
        unset($items[$request->index]);
        session(['slc.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }


    public function getItemTable()
    {
        $items =  session('slc.items') ?? [];
        return view('pages.StockLocationChange.item_list', compact('items'));
    }


    public function approvalIndex()
    {
        $stock_location_changes =  StockLocationChange::get();

        return view('pages.StockLocationChange.Approval.index', compact('stock_location_changes'));
    }
    public function approvalCreateIndex(StockLocationChange $slc)
    {
        $employees = Employee::get();
        return view('pages.StockLocationChange.Approval.create', compact('slc', 'employees'));
    }

    public function approvalStore(Request $request, StockLocationChange $slc)
    {
        $stockLog = new StockLogService;

        $this->validate($request, [
            'approved_date' => 'required|date',
            'approved_by' => 'required',
            'approved_status' => 'required',
        ]);

        $slc->approved_date = $request->approved_date;
        $slc->approved_by = $request->approved_by;
        $slc->approved_status = $request->approved_status;
        $slc->approved_remark = $request->approved_remark;
        $slc->save();

        foreach($slc->items as $item){
        $stockLog->createLog(
            StockLogService::$STOCK_LOCATION_ISSUED,
            $slc->from_location,
            data_get($item,'stock_item_id'),
            data_get($item,'qty'),
            StockLogService::$DEDUCT,
            $slc->slc_number,
            $request->user()->id,
            null,
        );

    }
        if ($request->approved_status == "approved") {
            //stock
            foreach ($slc->items as $key => $item) {
                $stock_from = Stock::where('stock_item_id', $item['stock_item_id'])->where('warehouse_id', $slc->from_location)->first();
                $stock_from->qty = $stock_from->qty - $item['qty'];
                $stock_from->save();
            }
        }

        flash()->success('Stock Location Change Updated successfully!');
        return redirect()->route('stocklocationchange_approvals.index');
    }

    public function receivedIndex()
    {
        $stock_location_changes =  StockLocationChange::where('approved_status', 'approved')->get();
        return view('pages.StockLocationChange.Received.index', compact('stock_location_changes'));
    }
    public function receivedCreateIndex(StockLocationChange $slc)
    {
        $employees = Employee::get();
        return view('pages.StockLocationChange.Received.create', compact('employees', 'slc'));
    }

    public function receivedStore(Request $request, StockLocationChange $slc)
    {
        $stockLog = new StockLogService;

        $this->validate($request, [
            'received_date' => 'required|date',
            'received_by' => 'required',
        ]);

        $slc->received_by = $request->received_by;
        $slc->received_date = $request->received_date;
        $slc->received_remark = $request->received_remark;
        $slc->save();

        foreach($slc->items as $item)
    {
        $stockLog->createLog(
            StockLogService::$STOCK_LOCATION_RECEIVED,
            $slc->to_location,
            data_get($item,'stock_item_id'),
           data_get($item,'qty'),
            StockLogService::$ADD,
            $slc->slc_number,
            $request->user()->id,
            null,
        );
    }

        //stock
        foreach ($slc->items as $key => $item) {
            $stock_to = Stock::where('stock_item_id', $item['stock_item_id'])->where('warehouse_id', $slc->to_location)->first();
            $stock_to->qty = $stock_to->qty + $item['qty'];
            $stock_to->save();
        }

        flash()->success('Stock Location Change Updated successfully!');
        return redirect()->route('stocklocationchange_received.index');
    }

    public function print($slc_id)
    {
        $slc_list =StockLocationChange::find($slc_id);

        if ($slc_id == null) {
            return abort(404);
        }

        $pdf = PDF::loadView('pages.StockLocationChange.print', compact('slc_list'))->setPaper('A5','landscape');
        return $pdf->stream();

    }
}
