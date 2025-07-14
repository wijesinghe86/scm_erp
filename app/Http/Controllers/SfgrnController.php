<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\InternalIssue;

class SfgrnController extends Controller
{

    public function index()
    {
        return view('pages.Sfgrn.index');
    }

    // public function generateNextNumber()
    // {
    //     $count  = FinishGood::get()->count();
    //     return "SFG" . sprintf('%06d', $count + 1);
    // }

    public function create()
    {
        $warehouses = Warehouse::get();
        $stock_items = StockItem::get();
        $internalIssues = InternalIssue::get();
        return view('pages.Sfgrn.create', compact('internalIssues', 'stock_items', 'warehouses'));
    }
}
