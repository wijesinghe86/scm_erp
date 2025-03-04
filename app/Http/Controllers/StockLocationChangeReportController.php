<?php

namespace App\Http\Controllers;

use App\Models\StockLocationChange;
use App\Models\StockLocationChangeItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use PDF;

class StockLocationChangeReportController extends Controller
{
    public function index()
    {
        $warehouse_lists = Warehouse::all();
        return view('pages.Reports.StockLocationChangeReport.index', compact('warehouse_lists'));
    }

    public function date_filter(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required',
            'frm_date' => 'required',
            'to_date' => 'required',
        ]);

        logger($request->all());

        $warehouses = Warehouse::find($request->warehouse_name);
        $slcLogs = StockLocationChangeItem::with('stock_item','from_warehouse', 'to_warehouse', 'slc_no')
            ->whereDate('created_at', ">=", $request->frm_date)
            ->whereDate('created_at', "<=", $request->to_date)
            ->where('from_location',  $request->warehouse_name)
            // ->where(function ($q) use ($request) {
            //     $q->where('from_location', $request->warehouse_name)
            //         ->orWhere('to_location', $request->warehouse_name);
            // })

            ->get();


        $pdf = PDF::loadView('pages.Reports.StockLocationChangeReport.datewise', compact('slcLogs', 'warehouses'))->setPaper('A4','landscape');
        return $pdf->stream();
    }
}
