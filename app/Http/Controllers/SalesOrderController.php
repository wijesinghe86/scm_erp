<?php

namespace App\Http\Controllers;

use PDF;

use App\Models\Invoice;
// use Barryvdh\DomPDF\PDF;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\DeliveryOrderItem;

class SalesOrderController extends Controller
{
    public function index(Request $request){

        {

            $invoices = Invoice::with(['Customer', 'createUser'])
            ->when($request->search, function($q) use ($request){
                $q->where('invoice_number', 'like', '%' . $request->search. '%')
                ->orwhere('payment_terms', 'like', '%' . $request->search. '%')
                ->orWhere(function ($qr) use ($request){
                    return $qr->whereHas('createUser', function ($createUser) use ($request){
                    $createUser->where('name', 'like', '%' . $request->search . '%');
                });
                  })
                  ->orWhere(function ($query) use ($request){
                        return $query->whereHas('Customer', function ($Customer) use ($request){
                            $Customer->where('customer_name', 'like', '%' . $request->search . '%');
            });
        });
    })
            ->latest()->paginate(50);
            return view ('pages.SalesOrder.index', compact('invoices'));

        }

        // $response['invoices'] = Invoice::all();
        // return view('pages.SalesOrder.index')->with($response);

    }

    public function view($invoice_id)
    {
        $response['invoices'] = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        $response['items'] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        // $response['deliveryorders'] = DeliveryOrderItem::all();
        if ($response['invoices'] == null) {
            return abort(404);
        }
        return view('pages.SalesOrder.view')->with($response);
    }

    public function print($invoice_id)
    {
        $invoices = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($invoices == null) {
            return abort(404);
        }

        // return view('pages.SalesOrder.print', compact('invoices'));
        $pdf = PDF::loadView('pages.SalesOrder.print', compact('invoices'))->setPaper('A4', 'portrait');
        return $pdf->stream('sales_order.print');
    }

}
