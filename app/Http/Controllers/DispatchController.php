<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 

class DispatchController extends Controller
{
    public function index()
    {

         return view('pages.Dispatch.index');
     }

     public function create()
    {
        return view('pages.Dispatch.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        Dispatch::create($request->all());

        $response['alert-success'] = 'Dispatch Details created successfully!';
        return redirect()->route('dispatch.index')->with($response);
    }
}
