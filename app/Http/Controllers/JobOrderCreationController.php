<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\PlantRegistration;
use App\Models\ProductionPlanning;


class JobOrderCreationController extends Controller
{
    public function index()
    {

         return view('pages.JobOrderCreation.index');
     }

     public function create()
    {
        $pps = ProductionPlanning::get();
        $plants = PlantRegistration::get();
        $employees = Employee::get();
        return view('pages.JobOrderCreation.create', compact('pps', 'plants', 'employees'));
    }


}
