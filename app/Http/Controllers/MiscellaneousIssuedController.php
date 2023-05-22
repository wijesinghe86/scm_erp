<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\StockItem;
use App\Models\MiscellaneousIssued;
use App\Models\MiscellaneousIssuedItem;
use Illuminate\Support\Facades\Auth;

class MiscellaneousIssuedController extends Controller
{
    public function index()
    {
        $miscissued =  MiscellaneousIssued::get();
        return view('pages.MiscellaneousIssued.index',compact('miscissued'));
     }

    public function create()
    {
        $stockItems = StockItem::get();
        $warehouses = Warehouse::get();
        $customers = Customer::get();

        $last_misc =  MiscellaneousIssued::latest()->first();
        $last_misc_number = 0;
        if($last_misc != null){
           $last_misc_number = $last_misc->id;
        }
        $misc_number = "MISI".sprintf("%04d", $last_misc_number+1);

        return view('pages.MiscellaneousIssued.create', compact('misc_number','customers','warehouses','stockItems'));

    }

    public function store(Request $request){
        $request['created_by'] = Auth::id();
        MiscellaneousIssued::create($request->all());

        $response['alert-success'] = 'Miscellaneous Issued Details created successfully!';
        return redirect()->route('miscissued.index')->with($response);
    }

    public function storeItem(Request $request)
    {
            $item = StockItem::find($request->item_id);
            MiscellaneousIssuedItem::create([
                'misc_number' => $request->issued_no,
                'item_id' => $request->item_id,
                'stock_no' => $item->stock_number,  //from stockitem table
                'description' => $item->description,  //from stockitem table
                'uom' => $item->unit,  //from stockitem table
                'location_id' => $request->location_id,
                'iss_qty' => $request->iss_qty,
                'iss_weight'=> $request->iss_weight
            ]);
    }

    public function itemsTable(Request $request)
    {
        $response['items'] = MiscellaneousIssuedItem::where('misc_number', $request->issued_no)->get();
        return view('pages.MiscellaneousIssued.Components.items_table')->with($response);
    }
}
