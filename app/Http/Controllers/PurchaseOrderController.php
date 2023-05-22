<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\PurchasingRequest;
use App\Models\PurchasingRequestItem;

class PurchaseOrderController extends Controller
{
    public function create()
    {
        $pr_list = PurchasingRequest::get();
        $suppliers = Supplier::get();
        $customers = Customer::get();

        $last_pr =  PurchaseOrder::latest()->first();
        $last_pr_number = 0;
        if($last_pr != null){
           $last_pr_number = $last_pr->id;
        }

        $next_number = "PO".sprintf("%04d", $last_pr_number+1);
        return view('pages.PurchaseOrder.create',compact('pr_list','next_number', 'suppliers', 'customers'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'po_number'=>'required',
        ]);
       //dd($request->all());
        $po = new PurchaseOrder;
        $po->po_number = $request->po_number;
        $po->po_date = $request->po_date;
        $po->delivery_date = $request->po_delivery_date;
        $po->supplier_id = $request->supplier_id;
        $po->customer_id = $request->customer_id;
        $po->po_type = $request->po_type;
        $po->weight_per_unit = $request->weight_per_unit;
        $po->volume_per_unit = $request->volume_per_unit;
        $po->total_weight = $request->total_weight;
        $po->total_volume = $request->total_volume;
        $po->pr_id = $request->pr_id;
        $po->save();

        foreach($request->items as $item):
            if(!isset($item['is_selected'])){
                continue;
            }
            $po_item = new PurchaseOrderItem;
            $po_item->item_id = $item['item_id'];
            $po_item->po_qty = $item['po_qty'];
            $po_item->po_id = $po->id;
            $po_item->save();
        endforeach;

        flash("PO created successfully")->success();
        return redirect()->back();

    }

    public function index()
    {
        return view('pages.PurchaseOrder.index');
    }

    public function getPrfItems(Request $request){
        $lists =  PurchasingRequestItem::with('item')
                ->where('pr_id',$request->pr_id)
                ->get();
        return view('pages.PurchaseOrder.prf_table',compact('lists'));
    }
}
