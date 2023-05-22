<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class OperationMechanismByProductController extends Controller
{
    public function index()
    {

         return view('pages.OperationMechanismByProduct.index');
     }

     public function create()
    {
        return view('pages.OperationMechanismByProduct.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        OperationMechanismByProduct::create($request->all());

        $response['alert-success'] = 'Operation Mechanism By Product created successfully!';
        return redirect()->route('operationmechanismbyproduct.index')->with($response);
    }
}
