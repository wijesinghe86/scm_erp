<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;


class RawMaterialIssueForProductionController extends Controller
{
    public function index()
    {

         return view('pages.RawMaterialIssueForProduction.index');
     }

     public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.RawMaterialIssueForProduction.create',compact('warehouses'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        RawMaterialIssueForProduction::create($request->all());

        $response['alert-success'] = 'Raw Material Issue For Production created successfully!';
        return redirect()->route('rawmaterialissueforproduction.index')->with($response);
    }
}
