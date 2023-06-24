<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class RawMaterialRequestController extends Controller
{
    public function index()
    {
       return view('pages.RawMaterialRequest.index');
    }

    public function create()
    {
       $employees = Employee::get();
        return view('pages.RawMaterialRequest.create', compact('employees'));
    }
}