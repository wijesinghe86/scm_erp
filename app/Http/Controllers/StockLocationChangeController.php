<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\FleetRegistration;
use App\Models\StockLocationChange;
use Illuminate\Support\Facades\Auth;
use App\Models\StockLocationChangeIssued;
use App\Models\StockLocationChangeReceived;

class StockLocationChangeController extends Controller
{
    public function index()
    {
        $slchange =  StockLocationChange::get();
        return view('pages.StockLocationChange.index',compact('slchange'));
    }

     public function create()
    {
        $stockItems = StockItem::get();
        $warehouses = Warehouse::get();
        $employees = Employee::get();
        $fleets = FleetRegistration::get();

        $items = session('slc.items') ?? [];
        // session(['slc.items'=>[]]);
        // dd($items);

        $last_slc =  StockLocationChange::latest()->first();
        $last_slc_number = 0;
        if($last_slc != null){
           $last_slc_number = $last_slc->id;
        }
        $slc_number = "SLC".sprintf("%04d", $last_slc_number+1);

        return view('pages.StockLocationChange.create',compact('warehouses','slc_number','stockItems','items','employees','fleets'));
    }

    public function store(Request $request)
    {
        //  dd($request->all());
        $request['created_by'] = Auth::user()->id;

        if ($request->button == "add") {
            return $this->addLineItem($request);
        }

        $this->validate($request, [
            'slc_date'=>'required|date',
            'delivered_by'=>'required',
            'delivered_date'=>'required',]);

            $items = session('slc.items') ?? [];

            if (count($items) == 0) {
                throw ValidationException::withMessages(['items'=>'please add products']);
            }

        $slc = new StockLocationChange();
        $slc->ref_number = $request->ref_number;
        $slc->slc_date = $request->slc_date;
        $slc->slc_number = $request->slc_number;
        $slc->delivered_by = $request->delivered_by;
        $slc->status = $request->status;
        $slc->delivered_date = $request->delivered_date;
        $slc->fleet_id = $request->fleet_id;
        $slc->remarks = $request->remarks;
        $slc->save();

        // for issued
        foreach ($items as $item)
        {
            $SLCIssuedItem = new StockLocationChangeIssued();
            $SLCIssuedItem->slc_id = $slc->id;
            $SLCIssuedItem->item_id = $item['item_id'];
            $SLCIssuedItem->stock_no = $item['stock_no'];
            $SLCIssuedItem->description = $item['description'];
            $SLCIssuedItem->uom = $item['uom'];
            $SLCIssuedItem->iss_qty = $item['iss_qty'];
            $SLCIssuedItem->location_id = $item['location_id'];
            $SLCIssuedItem->issued_by = $item['issued_by'];
            $SLCIssuedItem->iss_date = $item['iss_date'];

            $SLCIssuedItem->save();

            $SLCReceivedItem = new StockLocationChangeReceived();
            $SLCReceivedItem->slc_id = $slc->id;
            $SLCReceivedItem->item_id = $request->item_id;
            $SLCReceivedItem->stock_no = $request->stock_no;
            $SLCReceivedItem->description = $request->description;
            $SLCReceivedItem->uom = $request->uom;
            $SLCReceivedItem->revd_qty = $item['revd_qty'];
            $SLCIssuedItem->location_id = $item['location_id'];
            $SLCIssuedItem->received_by = $item['received_by'];
            $SLCIssuedItem->revd_date = $item['revd_date'];

            $SLCReceivedItem->save();

        }
        session(['slc.items'=>[]]); // clear the session
        flash('Stock Location Change created successfully!')->success();
        return redirect()->route('stocklocationchange.index');

        dd($request->all());
    }

    public function addLineItem (Request $request)
    {
         $this->validate($request, [
            'stock_no'=>'required',
            'item_id'=>'required|numeric',
            'uom'=>'required',
            'iss_qty'=>'required',],
        [
            'stock_item_id.required'=>"Description field required",
            'stock_item_id.numeric'=>"Description field must be a number",
        ]);


        $items =  session('slc.items') ?? [];
        $stock_item = StockItem::find($request->item_id);

        $items [$request->item_id] = [
            'stock_no' => $request->stock_no,  //from stockitem table
            'item_id'=>$stock_item->id,
            'description' => $stock_item->description,  //from stockitem table
            'uom' => $request->uom,  //from stockitem table
            'iss_qty' => $request->iss_qty,
            'revd_qty' => $request->revd_qty,
        ];

        session(['slc.items'=>$items]);
        return redirect()->back()->withInput();
        //dd("add line item success ")
    }

    public function deleteSessionItem($index)
    {
        $items =  session('slc.items') ?? [];
        unset($items[$index]);
        session(['slc.items'=>$items]);
        return  redirect()->back()->withInput();
    }

}
