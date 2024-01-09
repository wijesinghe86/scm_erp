<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        $stock_balance = Stock::with(['item', 'warehouse'])->get();
        return view('pages.StockBalance.index', compact('stock_balance'));

    }
    
}
