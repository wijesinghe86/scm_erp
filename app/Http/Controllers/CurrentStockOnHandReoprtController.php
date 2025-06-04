<?php

namespace App\Http\Controllers;
use PDF;
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
        return view('pages.Reports.StockOnHandReport.index', compact('warehouse_lists', 'stock_bal'));
    }

    public function generate_stockOnHand_report(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required',
            // 'frm_date' => 'required',
            // 'to_date' => 'required',
        ]);

       
        $warehouses = Warehouse::find($request->warehouse_name);
        $stocks = Stock::with('item', 'warehouse')->where('warehouse_id', $request->warehouse_name)
            ->where('qty', ">", '0')
            ->get();

            logger($stocks);

            $pdf = PDF::loadView('pages.Reports.StockOnHandReport.CurrentStockBalance', compact('warehouses', 'stocks'))->setPaper('A4','landscape');
            return $pdf->stream();

}


}