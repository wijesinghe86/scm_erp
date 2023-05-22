<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodsIssuedController extends Controller
{
    public function create()
    {
        return view('pages.GoodsIssueNote.create');
    }

    public function index()
    {
        return view('pages.GoodsIssueNote.index');
    }
}
