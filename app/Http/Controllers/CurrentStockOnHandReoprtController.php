<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrentStockOnHandReoprtController extends Controller
{
    public function index()
    {
        $warehouse_lists = Warehouse::all();
        $stock_bal = Stock::with('item','warehouse')->get();
        return view('pages.Reports.StockOnHandReport.index', compact('warehouse_lists', 'stock_item_lists', 'stock_log'));
    }

    // public function generate_history_report(Request $request)
    // {
    //     $request->validate([
    //         'warehouse_name' => 'required',
    //         'frm_date' => 'required',
    //         'to_date' => 'required',
    //     ]);

    //     logger($request->all());

    //     $warehouses = Warehouse::find($request->warehouse_name);
    //     $stockBal = Stock::with('item', 'warehouse')->where('warehouse_id', $request->$warehouse->id)
    //         ->whereDate('created_at', ">=", $request->frm_date)
    //         ->whereDate('created_at', "<=", $request->to_date)
    //         ->where('location',  $request->warehouse_name)

    //         ->get();
    // }
}