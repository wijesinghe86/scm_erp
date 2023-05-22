<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class JobOrderCreationController extends Controller
{
    public function index()
    {

         return view('pages.JobOrderCreation.index');
     }

     public function create()
    {

        return view('pages.JobOrderCreation.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        JobOrderCreation::create($request->all());

        $response['alert-success'] = 'JobOrderCreation created successfully!';
        return redirect()->route('jobordercreation.index')->with($response);
    }
}
