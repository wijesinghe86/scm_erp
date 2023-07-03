<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\Employee;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\FleetRegistration;
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
        $stockItems = StockItem::get();
        $warehouses = Warehouse::get();
        $employees = Employee::get();
        $fleets = FleetRegistration::get();

        $next_number = $this->generateNextNumber();
        return view('pages.StockLocationChange.create', compact('warehouses', 'stockItems', 'employees', 'fleets', 'next_number'));
    }

    public function store(Request $request)
    {
        $items = session('slc.items') ?? [];
        $this->validate($request, [
            'slc_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required',
            'from_location' => 'required',
            'received_by' => 'required',
            'received_date' => 'required',
            'to_location' => 'required',
            'delivered_by' => 'required',
            'delivered_date' => 'required',
            'fleet_id' => 'required',
        ]);

        if (count($items) == 0) {
            throw ValidationException::withMessages(['items' => 'please add products']);
        }

        try {
            DB::beginTransaction();
            $slc = new StockLocationChange;
            $slc->slc_number = $request->slc_number;
            $slc->slc_date = $request->slc_date;
            $slc->issued_by = $request->issued_by;
            $slc->issued_date = $request->issued_date;
            $slc->from_location = $request->from_location;
            $slc->received_by = $request->received_by;
            $slc->received_date = $request->received_date;
            $slc->to_location = $request->to_location;
            $slc->delivered_by = $request->delivered_by;
            $slc->delivered_date = $request->delivered_date;
            $slc->fleet_id = $request->fleet_id;
            $slc->created_by = request()->user()->id;
            $slc->remarks = $request->remarks;
            $slc->save();

            foreach ($items as $key => $item) {
                $slc_item = new StockLocationChangeItem;
                $slc_item->slc_id = $slc->id;
                $slc_item->from_location = $slc->from_location;
                $slc_item->to_location = $slc->to_location;
                $slc_item->stock_item_id = $item['stock_item_id'];
                $slc_item->qty = $item['issue_qty'];
                $slc_item->revd_qty = $item['revd_qty'];
                $slc_item->save();

                //stock 
                $stock_from = Stock::where('stock_item_id', $item['stock_item_id'])->where('warehouse_id', $slc->from_location)->first();
                $stock_from->qty = $stock_from->qty - $item['issue_qty'];
                $stock_from->save();

                $stock_to = Stock::where('stock_item_id', $item['stock_item_id'])->where('warehouse_id', $slc->to_location)->first();
                $stock_to->qty = $stock_to->qty + $item['issue_qty'];
                $stock_to->save();
            }
            DB::commit();
            session(['slc.items' => []]);
            flash()->success('Stock Location Change created successfully!');
            return redirect()->route('stocklocationchange.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
        }
    }

    public function addItemToTable(Request $request)
    {
        $this->validate(
            $request,
            [
                'stock_item_id' => 'required',
                'issue_qty' => 'required',
                'revd_qty' => 'required',
            ],
            [
                'stock_item_id.required' => 'The description field is required',
                'issue_qty.required' => 'The issued qty field is required',
                'revd_qty.required' => 'The revd qty field is required',
            ]
        );

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
            'revd_qty' => $request->revd_qty,
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
}
