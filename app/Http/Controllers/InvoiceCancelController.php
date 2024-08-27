<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;

class InvoiceCancelController extends Controller
{
   public function create(Request $request)
   {
    $invoices = Invoice::get();
    //logger($invoices);
    $deliveryOrders = [];
    return view ('pages.Invoices.cancellation.cancel', compact('invoices', 'deliveryOrders'));
   }


   public function getInvDetails(Request $request){
    $deliveryOrders = DeliveryOrder::where('issued_date','=', null)
    ->where('invoice_number', $request->invoice_number)
    ->get();
    return[
        'deliveryOrders'=>$deliveryOrders
    ];
}

   public function store(Request $request)
   {
    // $invoice  = Invoice::find($request->invoice_number);
    // $invoice->status = "created";
    // $invoice->save();


   }
}
