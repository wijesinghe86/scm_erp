<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\Employee;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\StockAdjustment;
use Illuminate\Support\Facades\DB;
use App\Models\StockAdjustmentItem;
use Illuminate\Log\Logger;
use Illuminate\Validation\ValidationException;

class StockAdjustmentController extends Controller
{

    public function generateNextNumber()
    {
        $count  = StockAdjustment::get()->count();
        return "SAN" . sprintf('%06d', $count + 1);
    }

    public function index()
    {
        $stock_adjustments = StockAdjustment::get();
        return view('pages.StockAdjustment.index', compact('stock_adjustments'));
    }

    public function create()
    {
        session(['san.items' => []]);
        $warehouses = Warehouse::get();
        $employees = Employee::get();
        $stock_items = StockItem::with(['stocks'])->get();
        $next_number = $this->generateNextNumber();
        return view('pages.StockAdjustment.create', compact('warehouses', 'next_number', 'stock_items', 'employees'));
    }

    public function store(Request $request)
    {
        $items =  session('san.items') ?? [];
        $data = $request->all();
        if (count($items) == 0) {
            throw ValidationException::withMessages(['items' => "At least one is required"]);
        }

        $is_exist = StockAdjustment::where('stock_adjustment_number', $request->stock_adjustment_number)->first();
        if ($is_exist) {
            $data['stock_adjustment_number'] = $this->generateNextNumber();
        }

        try {
            DB::beginTransaction();

            $stock_adjustment = new StockAdjustment;
            $stock_adjustment->stock_adjustment_number = $data['stock_adjustment_number'];
            $stock_adjustment->date = $request->stock_adjustment_date_;
            $stock_adjustment->type = $request->type;
            $stock_adjustment->created_by = $request->created_by;
            $stock_adjustment->save();

            foreach ($items as $key => $item) {
                $stock_adjustment_item = new StockAdjustmentItem;
                $stock_adjustment_item->stock_adjustment_id = $stock_adjustment->id;
                $stock_adjustment_item->from_warehouse = $item['from_warehouse'];
                $stock_adjustment_item->to_warehouse = $item['to_warehouse'];
                $stock_adjustment_item->from_stock_number = $item['from_stock_id'];
                $stock_adjustment_item->to_stock_number = $item['to_stock_id'];
                $stock_adjustment_item->qty = $item['qty'];
                $stock_adjustment_item->weight = $item['weight'];
                $stock_adjustment_item->justification = $item['justification'];
                $stock_adjustment_item->save();
            }

            DB::commit();
            flash()->success("Stock Adjustment created successfully!");
            return redirect()->route('stockadjustment.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
        }
    }

    public function addToTable(Request $request)
    {
        if ($request->type == "transfer") {
            $this->validate(
                $request,
                [
                    'from_warehouse' => 'required',
                    'to_warehouse' => 'required',
                    'from_stock_id' => 'required',
                    'to_stock_id' => 'required',
                    // 'weight' => 'required',
                    'qty' => 'required',
                ]
            );
        }

        if ($request->type != "transfer") {
            $this->validate(
                $request,
                [
                    'from_warehouse' => 'required',
                    'from_stock_id' => 'required',
                    'weight' => 'required',
                    'qty' => 'required',
                ]
            );
        }

        $items =  session('san.items') ?? [];

        $from_stock_item = StockItem::find($request->from_stock_id);
        $from_warehouse = Warehouse::find($request->from_warehouse);
        $to_stock_item =  StockItem::find($request->to_stock_id);
        $to_warehouse = Warehouse::find($request->to_warehouse);


        $items[] = [
            'from_warehouse' => $request->from_warehouse,
            'from_warehouse_name' =>  optional($from_warehouse)->warehouse_name,
            'to_warehouse' => $request->to_warehouse,
            'to_warehouse_name' => optional($to_warehouse)->warehouse_name,
            'from_stock_id' => $request->from_stock_id,
            'from_stock_item_stock_number' => optional($from_stock_item)->stock_number,
            'to_stock_id' => $request->to_stock_id,
            'to_stock_item_stock_number' => $request->type == "transfer" ? optional($to_stock_item)->stock_number : "",
            'weight' => $request->weight,
            'qty' => $request->qty,
            'justification' => $request->justification,
        ];

        session(['san.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Added',
        ];
    }

    public function removeFromTable(Request $request)
    {
        $items =  session('san.items') ?? [];
        unset($items[$request->index]);
        session(['san.items' => $items]);
        return [
            'success' => true,
            'message' => 'Item Removed'
        ];
    }

    public function viewTable()
    {
        $items =  session('san.items') ?? [];
        return view('pages.StockAdjustment.item_list', compact('items'));
    }

    public function approvalIndex(StockAdjustment $stock_adjustment)
    {
        $employees = Employee::get();
        return view('pages.StockAdjustment.approval', compact('stock_adjustment', 'employees'));
    }

    public function approval(Request $request, StockAdjustment $stock_adjustment)
    {
        $this->validate($request, [
            'approved_by' => 'required',
            'approved_status' => 'required',
        ]);

        $stock_adjustment->approved_by = $request->approved_by;
        $stock_adjustment->approved_status = $request->approved_status;
        $stock_adjustment->approved_at = now();
        $stock_adjustment->save();

        foreach ($stock_adjustment->items as $key => $item) {
            if ($stock_adjustment->type == "short" && $request->approved_status == "approved") {
                $from_stock = Stock::where('stock_item_id', $item['from_stock_number'])->where('warehouse_id', $item['from_warehouse'])->first();
                $from_stock->qty = $from_stock->qty - $item['qty'];
                $from_stock->save();
            }
            if ($stock_adjustment->type == "excess" && $request->approved_status == "approved") {
                $from_stock = Stock::where('stock_item_id', $item['from_stock_number'])->where('warehouse_id', $item['from_warehouse'])->first();
                $from_stock->qty = $from_stock->qty + $item['qty'];
                $from_stock->save();
            }

            if ($stock_adjustment->type == "transfer" && $request->approved_status == "approved") {
                $from_stock = Stock::where('stock_item_id', $item['from_stock_number'])->where('warehouse_id', $item['from_warehouse'])->first();
                $from_stock->qty = $from_stock->qty - $item['qty'];
                $from_stock->save();

                $to_stock = Stock::where('stock_item_id', $item['to_stock_number'])->where('warehouse_id', $item['to_warehouse'])->first();
                $to_stock->qty = $to_stock->qty + $item['qty'];
                $to_stock->save();

                logger($from_stock);
                logger($to_stock);
            }
        }

        flash()->success("Stock Adjustment updated successfully!");
        return redirect()->route('stockadjustment.index');
    }
}
