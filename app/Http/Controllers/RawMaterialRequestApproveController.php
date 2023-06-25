<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RawMaterialRequestApproveController extends Controller
{
    public function index()
    {
        return view('pages.RawMaterialRequest.RawMaterialRequestApprove.index');
    }

    public function create()
    {
        return view('pages.RawMaterialRequest.RawMaterialRequestApprove.create');
    }
    }

