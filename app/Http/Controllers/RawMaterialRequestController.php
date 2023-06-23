<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RawMaterialRequestController extends Controller
{
    public function index()
    {
       return view('pages.RawMaterialRequest.index');
    }

    public function create()
    {
        return view('pages.RawMaterialRequest.create');
    }
}