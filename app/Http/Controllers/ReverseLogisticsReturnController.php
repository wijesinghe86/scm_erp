<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\InvoiceReturn;
use App\Models\UrgentInvoice;
use App\Models\UrgentDelivery;
use App\Http\Controllers\Controller;

class ReverseLogisticsReturnController extends Controller
{
    public function index()
    {
        // $invoice_returns =  InvoiceReturn::all();
        // return view('pages.Returns.all', compact('invoice_returns'));
    }

    // public function new(Request $request)
    // {
    //     $customers = Customer::get();
    //     $warehouses = Warehouse::get();
    //     $customer_data = null;
    //     $reverse_invoices = [];

    //     $customer_id = $request->customer_id;

    //     $reverse_delivery_orders = [];
    //     $reverse_delivery_order = null;

    //     $invoice_return = new InvoiceReturn;
    //     $invoice_date = $request->invoice_date ? $request->invoice_date : null;
    //     $invoice_number  = $request->invoice_number ? $request->invoice_number : null;
    //     $delivery_order_no = $request->delivery_order_no ? $request->delivery_order_no : null;
    //     $customer_code = null;
    //     if ( $customer_id) {
    //         $customer_data = Customer::find( $customer_id);
    //         $reverse_invoices = UrgentInvoice::with(['delivery_order.items'])
    //             ->where('customer_id', $request->customer_id)
    //             ->where('is_returned', false)
    //             ->get();
    //     }


    //     if ($request->delivery_order_no) {
    //         $reverse_delivery_order = UrgentDelivery::where('id', $request->delivery_order_no)->first();
    //         if ($reverse_delivery_order == null) {
    //             return abort(404);
    //         }
    //     }
    //     return view('pages.ReverseLogisticsReturn.create', compact('customers', 'customer_data', 'reverse_invoices', 'warehouses', 'invoice_return', 'reverse_invoices', 'invoice_date', 'reverse_delivery_orders', 'invoice_number', 'customer_code', 'invoice_number', 'delivery_order_no', 'reverse_delivery_order'));
    // }

    public function new(Request $request)
    {
        $customers = Customer::get();
        $warehouses = Warehouse::get();
        return view('pages.ReverseLogisticsReturn.new', compact('customers', 'warehouses'));
    }

}
