<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PlantTimeManagementController extends Controller
{
    public function index()
    {

         return view('pages.PlantTimeManagement.index');
     }

     public function create()
    {
        return view('pages.PlantTimeManagement.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        PlantTimeManagement::create($request->all());

        $response['alert-success'] = 'Plant Time Management successfully!';
        return redirect()->route('planttimemanagement.index')->with($response);
    }
}
