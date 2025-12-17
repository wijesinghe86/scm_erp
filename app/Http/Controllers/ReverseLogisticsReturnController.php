<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UrgentDeliveryItem;
use App\Models\UrgentReturn;
use App\Models\UrgentReturnItem;
use Illuminate\Support\Facades\DB;
use App\Models\UrgentDelivery;
use App\Models\UrgentInvoice;

class ReverseLogisticsReturnController extends Controller
{

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
}
