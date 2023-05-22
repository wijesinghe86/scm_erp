<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class StockAdjustmentController extends Controller
{
    public function index()
    {

         return view('pages.StockAdjustment.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.StockAdjustment.create',compact('warehouses'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        StockAdjustment::create($request->all());

        $response['alert-success'] = 'Stock Adjustment created successfully!';
        return redirect()->route('stockadjustment.index')->with($response);
    }
}
