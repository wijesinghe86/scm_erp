<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\MrPurchase;
use Illuminate\Http\Request;
use App\Models\GoodsReceived;
use App\Models\MrPurchaseItem;
use App\Models\GoodsReceivedItem;
use App\Models\Stock;

class GoodsReceivedController extends Controller
{
    public function generateNextNumber()
    {
        $count  = GoodsReceived::get()->count();
        return "GRN" . sprintf('%07d', $count + 1);
    }

    public function index()

    {
        $goodsreceiveds = GoodsReceived::get();
        return view('pages.GoodsReceived.index', compact('goodsreceiveds'));
    }

    public function getPoItems(Request $request)
    {
        $lists = MrPurchaseItem::with('item')
            ->where('po_id', $request->po_id)
            ->get();
        return view('pages.GoodsReceived.po_table', compact('lists'));
    }

    public function create()
    {
        $warehouses = Warehouse::get();
        $suppliers = Supplier::get();
        $employees = Employee::get();
        $po_list = MrPurchase::with('get_supplier')->get();
        $goods = new GoodsReceived;
        $next_number = $this->generateNextNumber();
        return view('pages.GoodsReceived.create', compact('warehouses', 'suppliers', 'employees', 'po_list', 'next_number'));


        // $last_grn =  GoodsReceived::latest()->first();
        // $last_grn_number = 0;
        // if ($last_grn != null) {
        //     $last_grn_number = $last_grn->id;
        // }

        // $next_number = "GRN" . sprintf("%07d", $last_grn_number + 1);
        // return view('pages.GoodsReceived.create', compact('warehouses', 'suppliers', 'employees', 'po_list', 'next_number'));
    }

    public function store(Request $request)
    {
        $isGrnExist = GoodsReceived::where('grn_no', $request->grn_number)->first();
        if ($isGrnExist) {
            $data['grn_no'] = $this->generateNextNumber();
        }


        // dd($request->all());
        $grn = new GoodsReceived;
        $grn->grn_no = $request->grn_number;
        $grn->grn_date = $request->grn_date;
        $grn->type = $request->type_of_received;
        $grn->received_by = $request->received_by;
        $grn->received_date = $request->received_date;
        $grn->verified_by = $request->verified_by;
        $grn->verified_date = $request->verified_date;
        $grn->inspected_by = $request->inspected_by;
        $grn->inspected_date = $request->inspected_date;
        $grn->per_weight = $request->weight_per_unit;
        $grn->tot_weight = $request->total_weight;
        $grn->per_volume = $request->volume_per_unit;
        $grn->tot_volume = $request->total_volume;
        $grn->po_id = $request->po_id;
        $grn->created_by = request()->user()->id;
        $grn->supplier_id = $request->supplier;
        $grn->warehouse = $request->warehouse;
        $grn->save();

        foreach ($request->items as $item) :
            if (!isset($item['is_selected'])) {
                continue;
            }
            $grn_item = new GoodsReceivedItem();
            $grn_item->grn_id = $grn->id;
            $grn_item->stock_item_id = $item['item_id'];
            $grn_item->rec_qty = $item['rec_qty'];
            $grn_item->rec_weight = $item['rec_weight'];
            $grn_item->batch_no = $item['batch_no'];
            $grn_item->expiry_date = $item['expiry_date'];
            $grn_item->save();

            $is_stock_existing = Stock::where('stock_item_id', $item['item_id'])->where('warehouse_id', $request->warehouse)->first();
            if ($is_stock_existing) {
                $is_stock_existing->qty = $is_stock_existing->qty + $item['rec_qty'];
                $is_stock_existing->save();
            }
            if (!$is_stock_existing) {
                $stock = new Stock;
                $stock->stock_item_id = $item['item_id'];
                $stock->warehouse_id = $request->warehouse;
                $stock->qty = $item['rec_qty'];
                // $stock->grn_id = $grn->id;
                $stock->save();
            }

        endforeach;

        flash("GRN created successfully")->success();
        return redirect()->route('goodsreceived.index');
    }

    public function getGrnList(Request $request)
    {
        if (!$request->date && !$request->warehouse) {
            return [];
        }
        $grn_data = GoodsReceived::when($request->date, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
            ->when($request->date, function ($q) use ($request) {
                return $q->where('warehouse', $request->warehouse);
            });;
        return $grn_data;
    }
}
