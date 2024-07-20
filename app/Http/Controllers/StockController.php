<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stock_balance = Stock::with(['item', 'warehouse']) ->where('qty', '=', '0')->get();
        return view('pages.StockBalance.index', compact('stock_balance'));

    }
    public function index2(){
        $stock_balance2 = Stock::with(['item', 'warehouse'])
        ->where('qty', '>', '0')
        ->orwhere('qty', '<', '0')
        ->get();
        return view('pages.StockBalance.index2', compact('stock_balance2'));

    }

}
