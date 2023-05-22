<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
 

class WarehouseAreaDesignController extends Controller
{
    public function index()
    {

         return view('pages.WarehouseAreaDesign.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.WarehouseAreaDesign.create',compact('warehouses'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        WarehouseAreaDesign::create($request->all());

        $response['alert-success'] = 'Warehouse Area Design created successfully!';
        return redirect()->route('warehouseareadesign.index')->with($response);
    }
}
