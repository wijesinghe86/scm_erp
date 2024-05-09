<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerPaymentUpdate;

class CustomerPaymentUpdateController extends Controller
{
    public function generateNextNumber()
    {   $count  = CustomerPaymentUpdate::get()->count();
        return "PV" . sprintf('%06d', $count + 1);
    }
    public function create()
    {
        $customers = Customer::where('customer_type_of_customer', '=', 'credit')
                             ->where('customer_payment_terms', '=', 'credit')->get() ;
        $invoices = Invoice::all();
        $next_number = $this->generateNextNumber();
        return view('pages.CustomerPaymentUpdate.create', compact(['customers', 'invoices', 'next_number']));
    }

    public function getCusDetails(Request $request)
    {
        $invoice = Invoice::where('customer_id', $request->customer_id)
                            ->where('payment_terms', '=', 'credit')->get();
        return[
            'invoice'=>$invoice,    
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'customer_code'=> 'required',
            'received_amount'=> 'required',
            'received_date'=> 'required',
        ]);

        $isCpExist = CustomerPaymentUpdate::where('payment_code', $request->payment_code)->first();
            if ($isCpExist) {
                $data['payment_code'] = $this->generateNextNumber();
            }

            $customerPayment = new CustomerPaymentUpdate;
            $customerPayment->payment_code = $request->payment_code;
            $customerPayment->customer_code = $request->customer_code;
            $customerPayment->outstanding_amount = $request->outstanding_amount;
            $customerPayment->received_amount = $request->received_amount;
            $customerPayment->invoice_no = $request->invoice_no;
            $customerPayment->reference_no = $request->reference_no;
            $customerPayment->received_date = $request->received_date;
            $customerPayment->created_by = request()->user()->id;
            $customerPayment->save();

            flash()->success("Customer Payment Updated");
        return redirect()->back();
           

    }
}
