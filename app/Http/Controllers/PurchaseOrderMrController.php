<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\MrfPrfItem;
use App\Models\MrfPrfMain;
use App\Models\MrPurchase;
use Illuminate\Http\Request;
use App\Models\MrPurchaseItem;


class PurchaseOrderMrController extends ParentController
{
    public function generateNextNumber()
    {
        $count  = MrPurchase::get()->count();
        return "MPO" . sprintf('%06d', $count + 1);
    }


    public function index(){
        $lists = MrPurchase::all();
        return view ('pages.PurchaseOrderMr.index', compact('lists'));
    }

    public function getMrfPrfItems(Request $request){
        $lists =  MrfPrfItem::with('item')
                ->where('prf_id',$request->prf_id)
                ->get();
        return view('pages.PurchaseOrderMr.prfmrf_table',compact('lists'));
    }

    public function create(){
         $mrfprf_list = MrfPrfMain::with('items')->doesntHave('po_items')->get();
         $suppliers = Supplier::get();
         $customers = Customer::get();
         $mr_purchase = new MrPurchase;
         $next_number = $this->generateNextNumber();
         return view('pages.PurchaseOrderMr.create', compact('mrfprf_list', 'suppliers', 'customers', 'mr_purchase','next_number') );

        // $last_po =  MrPurchase::latest()->first();
        // $last_po_number = 0;
        // if($last_po != null){
        // $last_po_number = $last_po->id;
        // }

        // $next_number = "MPO".sprintf("%07d", $last_po_number+1);
        // return view('pages.PurchaseOrderMr.create', compact('mrfprf_list', 'suppliers', 'customers', 'next_number') );
    }

    public function store(Request $request){

        $isMpoExist = MrPurchase::where('po_no', $request->po_number)->first();
        if ($isMpoExist) {
            $data['po_no'] = $this->generateNextNumber();
        }

        $this->validate($request, [
            'prf_id'=>'required',
            'po_date'=>'required|date',
            'supplier_id'=>'required'
            ]);

        $po = new MrPurchase;
        $po->po_no = $request->po_number;
        $po->prf_id = $request->prf_id;
        $po->po_date = $request->po_date;
        $po->delivery_date = $request->po_delivery_date;
        $po->supplier_id = $request->supplier_id;
        $po->customer_id = $request->customer_id;
        $po->po_type = $request->po_type;
        $po->weight_per_unit = $request->weight_per_unit;
        $po->volume_per_unit = $request->volume_per_unit;
        $po->total_weight = $request->total_weight;
        $po->total_volume = $request->total_volume;
        $po->created_by = request()->user()->id;
        $po->save();

        foreach($request->items as $item):
            if(!isset($item['is_selected'])){
                continue;
            }
            $po_item = new MrPurchaseItem;
            $po_item->item_id = $item['item_id'];
            $po_item->po_qty = $item['po_qty'];
            $po_item->weight = $item['weight'];
            $po_item->po_id = $po->id;
            $po_item->prf_id = $po->prf_id;
            $po_item->save();
        endforeach;

        flash("PO created successfully")->success();
        return redirect()->route('purchase_order_mr.index');

    }



}
