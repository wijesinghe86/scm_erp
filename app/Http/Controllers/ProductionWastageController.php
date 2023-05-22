<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;


class ProductionWastageController extends Controller
{
    public function index()
    {

         return view('pages.ProductionWastage.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.ProductionWastage.create',compact('warehouses'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        ProductionWastage::create($request->all());

        $response['alert-success'] = 'Production Wastage Details created successfully!';
        return redirect()->route('productionwastage.index')->with($response);
    }
}
