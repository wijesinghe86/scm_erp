<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WarehouseSafetyController extends Controller
{
    public function index()
    {

         return view('pages.WarehouseSafety.index');
     }

     public function create()
    {
        return view('pages.WarehouseSafety.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        WarehouseSafety::create($request->all());

        $response['alert-success'] = 'Warehouse Safety created successfully!';
        return redirect()->route('warehousesafety.index')->with($response);
    }
}
