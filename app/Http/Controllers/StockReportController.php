<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Models\StockLog;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use PDF;

class StockReportController extends Controller
{
    public function index()
    {
        $warehouse_lists = Warehouse::all();
        $stock_item_lists = StockItem::all();
        $stock_log = StockLog::with('item','warehouse')->get();
        return view('pages.Reports.StockStatusReports.stockreports', compact('warehouse_lists', 'stock_item_lists', 'stock_log'));
    }

    public function generate_history_report(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required',
            'stock_item' => 'required',
            'frm_date' => 'required',
            'to_date' => 'required',
        ]);

        logger($request->all());

        $items = StockItem::find($request->stock_item);
        $warehouses = Warehouse::find($request->warehouse_name);
        $stockLogs = StockLog::with('item', 'warehouse')->where('stock_id', $request->stock_item)
            ->whereDate('created_at', ">=", $request->frm_date)
            ->whereDate('created_at', "<=", $request->to_date)
            ->where('location',  $request->warehouse_name)
            // ->where(function ($q) use ($request) {
            //     $q->where('from_location', $request->warehouse_name)
            //         ->orWhere('to_location', $request->warehouse_name);
            // })
            ->get();

            $mappedStockLogs = $stockLogs->map(function ($stockLog, $index) use ($stockLogs) {
                $stockInHand = 0;

                if ($index == 0) {
                    // Initialize stock in hand based on the first item's transaction type
                    $stockInHand = $stockLog->transaction_type === "add"
                        ? $stockLog->qty
                        : -$stockLog->qty;
                } else {
                    // Retrieve the previous stock log item
                    $previousStockLog = $stockLogs->get($index - 1);
                    $previousStockInHand = $previousStockLog->stockInHand ?? 0;

                    // Calculate stock in hand based on the transaction type
                    $stockInHand = $stockLog->transaction_type == "add"
                        ? $previousStockInHand + $stockLog->qty
                        : $previousStockInHand - $stockLog->qty;
                }

                // Log debug information
                logger("Index: $index, StockInHand: $stockInHand");

                // Attach the stock in hand to the current log item
                $stockLog->stockInHand = $stockInHand;

                return [
                    "id" => $stockLog->id,
                    "event"=>$stockLog->event,
                    "stock_id" => $stockLog->stock_id,
                    "transaction_date"=>$stockLog->transaction_date,
                    "transaction_type" => $stockLog->transaction_type,
                    "qty" => $stockLog->qty,
                    "stockInHand" => $stockInHand
                ];
            });

        logger(count($mappedStockLogs));
        logger($mappedStockLogs);

        $pdf = PDF::loadView('pages.Reports.StockStatusReports.historyreport', compact('stockLogs', 'mappedStockLogs', 'items', 'warehouses'))->setPaper('A4','landscape');
        return $pdf->stream();
    }
}
