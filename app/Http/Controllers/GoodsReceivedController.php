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


class GoodsReceivedController extends Controller
{
    public function index()
    {
        return view('pages.GoodsReceived.index');
    }

    public function getPoItems(Request $request)
    {
        $lists = MrPurchaseItem::with('item')
                ->where('po_id', $request->po_id)
                ->get();
        return view('pages.GoodsReceived.po_table', compact('lists') );
    }

    public function create()
    {   $warehouses = Warehouse::get();
        $suppliers = Supplier::get();
        $employees = Employee::get();
        $po_list = MrPurchase::with('get_supplier')->get();

        $last_grn =  GoodsReceived::latest()->first();
        $last_grn_number = 0;
        if($last_grn != null){
        $last_grn_number = $last_grn->id;
        }

        $next_number = "GRN".sprintf("%07d", $last_grn_number+1);
        return view('pages.GoodsReceived.create', compact('warehouses', 'suppliers', 'employees', 'po_list', 'next_number'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $grn = new GoodsReceived;
        $grn->grn_no = $request->grn_number;
        $grn->grn_date =$request->grn_date;
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
        $grn->created_by = $request->user()->id;
        $grn->supplier_id = $request->supplier;
        $grn->warehouse = $request->warehouse;
        $grn->save();

        foreach($request->items as $item):
            if(!isset($item['is_selected'])){
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
    endforeach;

    flash("GRN created successfully")->success();
    return redirect()->back();
    }
}
