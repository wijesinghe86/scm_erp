<?php

namespace App\Http\Controllers;

use App\Models\DfApproved;
use Illuminate\Http\Request;
use App\Models\DemandForecasting;
use App\Models\DemandForecastingItems;

class DfApprovalController extends Controller
{
   public function index()
   {
    return view('pages.DemandForecasting.DFApprove.index');
   }

public function create()
   {
    $df_list = DemandForecasting::get();
    return view('pages.DemandForecasting.DFApprove.create', compact('df_list'));

   }

public function getDfApprovedItems(Request $request){
    $lists = DemandForecastingItems::with('item')
             ->where ('df_id', $request->df_id)
             ->get();
             return view('pages.DemandForecasting.DFApprove.dfItem', compact('lists'));
}

public function store(Request $request)
{
    //dd($request->all());
    foreach($request->items as $row)
    {
        if(!isset($row['is_selected']))
        {
            continue;
        }
    }
    $item = DemandForecastingItems::with(['demandforecastid','item'])->where('id', $row['df_item_id'])->first();

    if($item == null){
    throw validationException::withMessage(["df_item_id"=>"Invalid Demand Forecasting item_id"]);
     }

    $df_approved = new DfApproved();
    $df_approved->df_item_id = $row['df_item_id'];
    $df_approved->df_id = $item->df_id;
    $df_approved->item_id = $row['item_id'];
    $df_approved->approved_qty = $row['approved_qty'];
    $df_approved->action = $row['action'];
    $df_approved->remark = $row['remark']??"";
    $df_approved->approved_user_id = request()->user()->id;
    $df_approved->save();
}
}
