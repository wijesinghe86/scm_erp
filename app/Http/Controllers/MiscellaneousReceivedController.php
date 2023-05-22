<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\StockItem;
use Illuminate\Support\Facades\Auth;
use App\Models\MiscellaneousReceived;
use App\Models\MiscellaneousReceivedItem;

class MiscellaneousReceivedController extends ParentController
{
    public function index()
    {
        $miscreceived =  MiscellaneousReceived::get();
        return view('pages.MiscellaneousReceived.index',compact('miscreceived'));
     }

    public function create()
    {
        $stockItems = StockItem::get();
        $warehouses = Warehouse::get();
        $suppliers = Supplier::get();

        $last_misc =  MiscellaneousReceived::latest()->first();
        $last_misc_number = 0;
        if($last_misc != null){
           $last_misc_number = $last_misc->id;
        }
        $misc_number = "MISR".sprintf("%04d", $last_misc_number+1);

        return view('pages.MiscellaneousReceived.create', compact('misc_number','suppliers','warehouses','stockItems'));
    }

    public function store(Request $request){
        $request['created_by'] = Auth::id();
        MiscellaneousReceived::create($request->all());

        $response['alert-success'] = 'Miscellaneous Received Details created successfully!';
        return redirect()->route('miscreceived.index')->with($response);
    }

    public function storeItem(Request $request)
    {
            $item = StockItem::find($request->item_id);
            MiscellaneousReceivedItem::create([
                'misc_number' => $request->rec_no,
                'item_id' => $request->item_id,
                'stock_no' => $item->stock_number,  //from stockitem table
                'description' => $item->description,  //from stockitem table
                'uom' => $item->unit,  //from stockitem table
                'location_id' => $request->location_id,
                'rec_qty' => $request->rec_qty,
                'rec_weight'=> $request->rec_weight
            ]);
    }

    public function itemsTable(Request $request)
    {
        $response['items'] = MiscellaneousReceivedItem::where('misc_number', $request->rec_no)->get();
        return view('pages.MiscellaneousReceived.Components.items_table')->with($response);
    }
}
