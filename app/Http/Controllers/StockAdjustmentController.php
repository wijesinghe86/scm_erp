<?php

namespace App\Http\Controllers;

use App\Models\StockAdjustment;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class StockAdjustmentController extends Controller
{

    public function generateNextNumber()
    {
        $count  = StockAdjustment::get()->count();
        return "SAJ" . sprintf('%06d', $count + 1);
    }

    public function index()
    {
        return view('pages.StockAdjustment.index');
    }

    public function create()
    {
        $warehouses = Warehouse::get();
        return view('pages.StockAdjustment.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        flash()->success("Stock Adjustment created successfully!");
        return redirect()->route('stockadjustment.index');
    }
}
