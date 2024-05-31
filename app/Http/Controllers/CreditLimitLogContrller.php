<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerCreditLimitLog;

class CreditLimitLogContrller extends Controller
{
    public function index()
    {
        $creditLimitLogs = CustomerCreditLimitLog::all();
        return view('pages.CreditLimitLog.index', compact('creditLimitLogs'));
    
}
}
