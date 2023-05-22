<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductionCostController extends Controller
{
    public function index()
    {

         return view('pages.ProductionCost.index');
     }

     public function create()
    {
        return view('pages.ProductionCost.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        ProductionCost::create($request->all());

        $response['alert-success'] = 'Production Cost created successfully!';
        return redirect()->route('productioncost.index')->with($response);
    }
}
