<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ManAndEquipmentSafetyController extends Controller
{
    public function index()
    {

         return view('pages.ManAndEquipmentSafety.index');
     }

     public function create()
    {
        return view('pages.ManAndEquipmentSafety.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        ManAndEquipmentSafety::create($request->all());

        $response['alert-success'] = 'Man And Equipment Safety created successfully!';
        return redirect()->route('manandequipmentsafety.index')->with($response);
    }
}
