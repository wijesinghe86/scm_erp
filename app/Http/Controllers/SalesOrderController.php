<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    public function index(){

        $response['invoices'] = Invoice::all();
        return view('pages.SalesOrder.index')->with($response);

    }

    public function view($invoice_id)
    {
        $response['invoices'] = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        $response['items'] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($response['invoices'] == null) {
            return abort(404);
        }
        return view('pages.SalesOrder.view')->with($response);
    }
}
