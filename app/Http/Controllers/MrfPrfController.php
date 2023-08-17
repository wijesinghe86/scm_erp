<?php

namespace App\Http\Controllers;

use App\Models\MrfPrfItem;

use App\Models\MrfPrfMain;
use Illuminate\Http\Request;
use App\Models\MaterialRequest;
use App\Models\MaterialRequestItem;


class MrfPrfController extends ParentController
{
    public function index()
    {   $lists = MrfPrfMain::all();
        return view('pages.mrfprf.index',compact('lists'));
    }

    public function generateNextNumber()
    {
        $count  = MrfPrfMain::get()->count();
        return "MPRF" . sprintf('%04d', $count + 1);
    }


    public function create()
    {   $mr_list = MaterialRequest::with('mr_approved')
        ->whereHas('mr_approved',function($q){
        $q->where('status','approved');
        })->get();
        // ->doesntHave('prf_items')
        $purchase = new MrfPrfMain;
        $next_number = $this->generateNextNumber();
        return view('pages.mrfprf.create', compact('mr_list', 'next_number'));


        // $last_prf = MrfPrfMain::latest()->first();
        // $last_prf_number = 0;
        // if($last_prf != null){
        // $last_prf_number = $last_prf->id;
        // }
        // $next_number = "MPRF".sprintf("%04d", $last_prf_number+1);

        // return view('pages.mrfprf.create', compact('mr_list', 'next_number'));
    }

    public function getMrfItems(Request $request)
    {
        $lists =  MaterialRequestItem::with(['item','approval'])
                ->where('mr_id', $request->mr_id)
                ->approvedForPurchase()
                ->get();
        return view('pages.mrfprf.mrf_table', compact('lists'));
    }

    public function store(Request $request)
    {
        $isPrfExist = MrfPrfMain::where('mrfprf_no', $request->mrfprf_no)->first();
            if ($isPrfExist) {
                $data['mrfprf_no'] = $this->generateNextNumber();
            }

        //dd($request->all());
        $mrfprf = new MrfPrfMain;
        $mrfprf->mrfprf_no = $request->mrfprf_no;
        $mrfprf->mrfprf_date = $request->mrfprf_date;
        $mrfprf->created_by_id = request()->user()->id;
        $mrfprf->save();

        foreach ($request->items as $row) {
            if(!isset($row['is_selected'])){
                continue;
            }

            $mrfprf_item = new MrfPrfItem();
            $mrfprf_item->stock_item_id = $row['item_id'];
            $mrfprf_item->prfqty = $row['qty'];
            $mrfprf_item->mr_id = $request->mr_id;
            $mrfprf_item->prf_id = $mrfprf->id;
            $mrfprf_item->save();
    }

    flash()->success("Purchase Request created");
    return redirect()->route('mrfprf.index');
}


}
