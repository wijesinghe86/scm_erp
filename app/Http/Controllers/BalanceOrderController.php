<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Warehouse;
use App\Models\BalanceOrder;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;
use Illuminate\Support\Facades\DB;

class BalanceOrderController extends Controller
{
    public function index()
    {
        $balance_orders = BalanceOrder::get();
        return view('pages.BalanceOrder.index', compact('balance_orders'));
    }

    public function view(BalanceOrder $balance_order)
    {
        return view('pages.BalanceOrder.view', compact('balance_order'));
    }

    public function deliveryOrderCreateIndex(BalanceOrder $balance_order)
    {
        if ($balance_order->is_issued) {
            return abort(404);
        }
        $warehouses = Warehouse::get();
        return view('pages.BalanceOrder.create_delivery_order', compact('balance_order', 'warehouses'));
    }

    public function deliveryOrderCreate(Request $request, BalanceOrder $balance_order)
    {
        logger(collect($request->cart)->groupBy('location_id'));
        logger($balance_order);

        try {
            DB::beginTransaction();
            $balance_order->is_issued = true;
            $balance_order->save();
            foreach (collect($request->cart)->groupBy('location_id') as $location_id => $items) {
                $delivery_order = new DeliveryOrder;
                $delivery_order->invoice_number = $balance_order->invoice_number;
                $delivery_order->delivery_order_no = $delivery_order->generateDeliveryOrderNumber();
                $delivery_order->location_id = $location_id;
                $delivery_order->customer_id = $balance_order->invoice->customer_id;
                $delivery_order->invoice_date = $balance_order->invoice_date;
                $delivery_order->balance_order_id = $delivery_order->id;
                $delivery_order->created_by = request()->user()->id;
                $delivery_order->save();

                foreach ($items as $item) {
                    $delivery_order_item = new DeliveryOrderItem;
                    $delivery_order_item->delivery_order_no = $delivery_order->id;
                    $delivery_order_item->invoice_id = $balance_order->invoice->id;
                    $delivery_order_item->item_id  = data_get($item, 'item_id');
                    $delivery_order_item->stock_no  = data_get($item, 'stock_no');
                    $delivery_order_item->description  = data_get($item, 'description');
                    $delivery_order_item->qty  = data_get($item, 'qty');
                    $delivery_order_item->unit_price  = data_get($item, 'unit_price');
                    $delivery_order_item->created_by = request()->user()->id;
                    $delivery_order_item->uom  = data_get($item, 'uom');
                    $delivery_order_item->location  = data_get($item, 'location_id');
                    $delivery_order_item->sub_total  = data_get($item, 'sub_total');
                    $delivery_order_item->total  = data_get($item, 'total');
                    $delivery_order_item->save();
                }
            }
            DB::commit();
            return route('balanceorder.view', $balance_order->id);
        } catch (Exception $error) {
            logger($error);
            DB::rollBack();
        }
    }
}
