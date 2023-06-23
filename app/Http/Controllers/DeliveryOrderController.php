<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Warehouse;
// use App\Models\Item;
use App\Models\BalanceOrder;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\StockItem;
use App\Models\BalanceOrderItem;
use App\Models\DeliveryOrderItem;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;


class DeliveryOrderController extends ParentController
{
    public function all()
    {
        $deliveryOrders = DeliveryOrder::all();
        return view('pages.DeliveryOrder.all', compact('deliveryOrders'));
    }

    public function view(DeliveryOrder $delivery_order)
    {
        if ($delivery_order == null) {
            abort(404);
        }
        return view('pages.DeliveryOrder.view', compact('delivery_order'));
    }


    public function issueIndex(DeliveryOrder $delivery_order)
    {
        if ($delivery_order == null || $delivery_order->issued_date != null) {
            abort(404);
        }

        return view('pages.DeliveryOrder.issue', compact('delivery_order'));
    }

    public function issueStore(Request $request, DeliveryOrder $delivery_order)
    {
        try {
            DB::beginTransaction();
            $balance_order =  new BalanceOrder;
            $balance_order->balance_order_no = $balance_order->generateBalanceOrderNumber();
            $balance_order->delivery_order_id = $delivery_order->id;
            $balance_order->invoice_number = $delivery_order->invoice_number;
            $balance_order->invoice_date = $delivery_order->invoice_date;
            $balance_order->location_id = $delivery_order->location_id;
            $balance_order->created_by = Auth::id();

            $delivery_order->issued_date = now();
            $delivery_order->save();

            foreach ($request->items as $key => $item) {
                $delivery_order_item = DeliveryOrderItem::where('id', $key)->first();

                $delivery_order_item->issued_qty = $delivery_order_item->issued_qty + $item['issue_quantity'];
                // $delivery_order_item->available_qty = $item['issue_quantity'] > 0 ? $delivery_order_item->qty - $delivery_order_item->issued_qty : 0;
                $delivery_order_item->available_qty = $delivery_order_item->qty - $delivery_order_item->issued_qty;
                $delivery_order_item->issued_date = now();
                $delivery_order_item->save();

                //stock reduce 
                $stock = Stock::where('stock_item_id', $delivery_order_item->item_id)->where('warehouse_id', $delivery_order->location_id)->first();
                $stock->qty = $stock->qty - $item['issue_quantity'];
                $stock->save();


                $is_existing_balance_order_item = BalanceOrderItem::where('delivery_order_item_id', $delivery_order_item->id)->first();
                if ($is_existing_balance_order_item) {
                    $is_existing_balance_order_item->delete();
                }


                // if ($item['issue_quantity'] != 0 &&  $delivery_order_item->issued_qty < $delivery_order_item->qty) {
                if ($delivery_order_item->issued_qty < $delivery_order_item->qty) {
                    $is_existing_balance_order = BalanceOrder::where('delivery_order_id', $delivery_order->id)->first();
                    if ($is_existing_balance_order == null) {
                        $balance_order->save();
                    }

                    $balance_order_item = new BalanceOrderItem;
                    $balance_order_item->delivery_order_id  = $delivery_order->id;
                    $balance_order_item->balance_order_id  = $is_existing_balance_order == null ? $balance_order->id : $is_existing_balance_order->id;
                    $balance_order_item->delivery_order_item_id  = $delivery_order_item->id;
                    $balance_order_item->item_id  = $delivery_order_item->item_id;
                    $balance_order_item->invoice_id  =  $delivery_order_item->invoice_id;
                    $balance_order_item->stock_no  =  $delivery_order_item->stock_no;
                    $balance_order_item->description  =  $delivery_order_item->description;
                    $balance_order_item->unit_price  =  $delivery_order_item->unit_price;
                    $balance_order_item->uom  = $delivery_order_item->uom;;
                    $balance_order_item->qty  =  $delivery_order_item->qty - $delivery_order_item->issued_qty;
                    $balance_order_item->unit_price  =   $delivery_order_item->unit_price;
                    $balance_order_item->location  =   $delivery_order_item->location;
                    $balance_order_item->created_by  = Auth::id();
                    $balance_order_item->save();
                }
            }
            DB::commit();
            return view('pages.DeliveryOrder.issue', compact('delivery_order'));
            // return redirect()->route('deliveryorders.view', $delivery_order->id);
        } catch (Exception $th) {
            logger($th);
            DB::rollback();
        }
    }

    public function new()
    {
        $customers = Customer::get();
        $employees = Employee::get();
        $stockItems = StockItem::get();
        $warehouses = Warehouse::get();
        $invoices = Invoice::get();


        $last_do =  DeliveryOrder::latest()->first();
        $last_do_number = 0;
        if ($last_do != null) {
            $last_do_number = $last_do->id;
        }
        $delivery_order_no = "DO" . sprintf("%06d", $last_do_number + 1);

        return view('pages.DeliveryOrder.new', compact('customers', 'employees', 'stockItemem_mains', 'warehouses', 'delivery_order_no', 'invoices'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request['created_by'] = Auth::id();

        $delivery_order = DeliveryOrder::create($request->all());
        return redirect()->route('invoices.preview', $delivery_order->id);
    }

    public function getInvoiceItems(Request $request)
    {
        // dd($request->all());
        $invoiceitems = InvoiceItem::with('item')
            ->where('invoice_number', $request->invoice_no)
            ->get();
        return view('pages.DeliveryOrder.items_table', compact('invoiceitems'));
    }


    public function print($delivery_order_id)
    {
        $delivery_order = DeliveryOrder::with(['items', 'customer','location'])->find($delivery_order_id);
        // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($delivery_order == null) {
            return abort(404);
        }
        $pdf = PDF::loadView('pages.DeliveryOrder.pdf', compact('delivery_order'));
        return $pdf->stream('delivery_order.pdf');
    }
}
