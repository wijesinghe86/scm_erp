<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class OperationMachanismProductionAndTimeManagementController extends Controller
{
    public function index()
    {

         return view('pages.OperationMachanismProductionAndTimeManagement.index');
     }

     public function create()
    {
        return view('pages.OperationMachanismProductionAndTimeManagement.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        OperationMachanismProductionAndTimeManagement::create($request->all());

        $response['alert-success'] = 'Operation Machanism Production And Time Management created successfully!';
        return redirect()->route('operationmachanismproductionandtimemanagement.index')->with($response);
    }
}
