<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Stock;
use App\Models\Customer;
use App\Models\Warehouse;
use App\Models\UrgentReturn;
use Illuminate\Http\Request;
use App\Models\UrgentInvoice;
use App\Models\UrgentDelivery;
use App\Models\UrgentReturnItem;
use App\Services\StockLogService;
use App\Models\UrgentDeliveryItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReverseLogisticsReturnController extends Controller
{
public function index()
{
$urgent_return = UrgentReturn::get();
return view('pages.ReverseLogisticsReturn.index', compact('urgent_return'));
}
    public function generateInvoiceNumber()
    {
        $invoice_count = UrgentReturn::count();
        $prefix = "RMRS";
        return $prefix . sprintf('%06d', $invoice_count + 1);
    }

    public function new(Request $request)
    {
        $customers = Customer::get();
        $warehouses = Warehouse::get();
        return view('pages.ReverseLogisticsReturn.new', compact('customers', 'warehouses'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $urgentReturn = new UrgentReturn();
            $urgentReturn->invoice_id = $request->invoice['id'];
            $urgentReturn->delivery_order_id = $request->delivery_order['id'];
            $urgentReturn->payment_method = $request->payment_method;
            $urgentReturn->location_id = $request->location['id'];
            $urgentReturn->created_by = request()->user()->id;
            $urgentReturn->return_reason = $request->return_reason;
            $urgentReturn->is_approved = false;
            $urgentReturn->return_no = $this->generateInvoiceNumber();
            $urgentReturn->save();

            foreach ($request->items as $item) {

                $invoiceItem = collect($request->invoice['items'])->firstWhere('item_id', $item['item_id']);

                $unit_price = $invoiceItem['unit_price'];
                $total = $unit_price * $item['returned_qty'];
                $sub_total = $unit_price * $item['returned_qty'];

                $urgentReturnItem = new UrgentReturnItem();
                $urgentReturnItem->invoice_id = $request->invoice['id'];
                $urgentReturnItem->return_id = $urgentReturn->id;
                $urgentReturnItem->item_id = $item['item_id'];
                $urgentReturnItem->location_id = $request->location['id'];
                $urgentReturnItem->delivery_order_item_id = $item['id'];
                $urgentReturnItem->stock_no = $item['item']['stock_number'];
                $urgentReturnItem->description = $item['item']['description'];
                $urgentReturnItem->uom = $item['item']['unit'];
                $urgentReturnItem->quantity = $item['returned_qty'];
                $urgentReturnItem->unit_price = $unit_price;
                $urgentReturnItem->total = $total;
                $urgentReturnItem->sub_total = $sub_total;
                $urgentReturnItem->save();

                $urgentInvoiceItem = UrgentDeliveryItem::find($item['id']);
                $urgentInvoiceItem->return_qty = $urgentInvoiceItem->return_qty + $item['returned_qty'];
                $urgentInvoiceItem->remaining_qty = $urgentInvoiceItem->remaining_qty - $item['returned_qty'];
                $urgentInvoiceItem->save();
            }


            $urgentDelivery = UrgentDelivery::with('items')->find($request->delivery_order['id']);
            $remainingQty = collect($urgentDelivery->items)->sum('remaining_qty');
            if ($remainingQty == 0) {
                $urgentDelivery->is_returned = true;
                $urgentDelivery->save();
                $urgentInvoice = UrgentInvoice::find($request->invoice['id']);
                $urgentInvoice->is_returned = true;
                $urgentInvoice->save();
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
        }
    }

    public function view(UrgentReturn $urgent_returns)
    {
        return view('pages.ReverseLogisticsReturn.view', compact('urgent_returns'));
    }

    public function approvalIndex()
    {
        $urgent_return =  UrgentReturn::where('is_approved', true)->get();
        return view('pages.Returns.approval', compact('urgent_return'));
    }

    public function approval(Request $request, UrgentReturn $urgent_returns)
    {
        $stockLog = new StockLogService;

        $urgent_returns->is_approved = true;
        $urgent_returns->approved_by = request()->user()->id;
        $urgent_returns->save();

        foreach($urgent_returns->items as $item)
        {
            //logger($item);
            $stock = Stock::where('stock_item_id', data_get($item, 'item_id'))
                        ->where('warehouse_id', data_get($item, 'location_id'))
                        ->first();
                    $stock->qty = $stock->qty + data_get($item, 'quantity');
                    $stock->save();

                    $stockLog->createLog(
                            StockLogService::$REVERSE_RETURN,
                            data_get($item, 'location_id'),
                            data_get($item, 'item_id'),
                            data_get($item, 'quantity'),
                            StockLogService::$ADD,
                            $urgent_returns->return_no,
                            $request->user()->id,
                            null,
                        );

}
$response['alert-success'] = 'Return Approved Successfully!';

return redirect()->back()->with($response);
}
public function print($return_id)
    {
        $rmrs_list =UrgentReturn::find($return_id);

        // $stock_adjustmet_items = StockAdjustmentItem::with(['fromWarehouse', 'from_stock_item'])->find($stock_adjustment_id);

        $pdf = PDF::loadView('pages.ReverseLogisticsReturn.print', compact('rmrs_list'))->setPaper('A5','landscape');
        return $pdf->stream();
    }

}