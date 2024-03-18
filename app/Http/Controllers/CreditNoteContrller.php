<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreditNoteContrller extends Controller
{
    public function index()
    {
        return view ('pages.CreditNote.index');
    }
}
