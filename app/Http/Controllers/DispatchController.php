<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\FleetRegistration;


class DispatchController extends Controller
{
    public function index()
    {

         return view('pages.Dispatch.index');
     }

     public function create()
    {
        $employees = Employee::get();
        $fleets = FleetRegistration::get();
        return view('pages.Dispatch.create', compact('employees', 'fleets'));
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
