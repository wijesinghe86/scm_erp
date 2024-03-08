<?php

namespace App\Http\Controllers;

use PDF;

use App\Models\Invoice;
// use Barryvdh\DomPDF\PDF;
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

    public function print($invoice_id)
    {
        // // $invoices = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        // $response['invoices'] = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        // $response['items'] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        // // $response['invoices'] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        // // if ($invoices == null) {
        // //     return abort(404);
        // // }

        // // return view('pages.SalesOrder.print', compact('invoices'));
        // $pdf = PDF::loadView('pages.SalesOrder.print', $response);
        // // return $pdf->stream('sales_order.print');
        // return $pdf->dowload('sales_order.print');
    }

}
