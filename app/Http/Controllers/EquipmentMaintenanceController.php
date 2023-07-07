<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentMaintenanceController extends Controller
{

    public function index()
    {

         return view('pages.EquipmentMaintenance.index');
     }

     public function create()
    {
        return view('pages.EquipmentMaintenance.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Supplier::create($request->all());

        // $request['created_by'] = Auth::id();

        EquipmentMaintenance::create($request->all());

        $response['alert-success'] = 'Equipment Maintenance created successfully!';
        return redirect()->route('equipmentmaintenance.index')->with($response);
    }
}
