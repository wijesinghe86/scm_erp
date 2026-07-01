<?php

namespace App\Http\Controllers;

use PDF;

use App\Http\Controllers\Controller;
use App\Models\DitributorInvice;
use App\Models\DitributorInviceItem;
use Illuminate\Http\Request;

class SalesOrderNewController extends Controller
{
    public function index(Request $request){

        {

            $invoices = DitributorInvice::with(['Customer', 'createUser'])
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
            return view ('pages.SalesOrderNew.index', compact('invoices'));

        }

        // $response['invoices'] = Invoice::all();
        // return view('pages.SalesOrder.index')->with($response);

    }

    public function view($invoice_id)
    {
        $response['invoices'] = DitributorInvice::with(['Items', 'Customer'])->find($invoice_id);
        $response['items'] = DitributorInviceItem::where('invoice_number', $invoice_id)->get();
        // $response['deliveryorders'] = DeliveryOrderItem::all();
        if ($response['invoices'] == null) {
            return abort(404);
        }
        return view('pages.SalesOrderNew.view')->with($response);
    }

    public function print($invoice_id)
    {
        $invoices = DitributorInvice::with(['Items', 'Customer'])->find($invoice_id);
        // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($invoices == null) {
            return abort(404);
        }

        // return view('pages.SalesOrder.print', compact('invoices'));
        $pdf = PDF::loadView('pages.SalesOrderNew.print', compact('invoices'))->setPaper('A4', 'portrait');
        return $pdf->stream('sales_order_new.print');
    }
}
