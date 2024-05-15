<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerPaymentUpdate;

class CustomerPaymentUpdateController extends Controller
{
    public function index()

    {
        $customerPaymentUpdates = CustomerPaymentUpdate::all();
        return view('pages.CustomerPaymentUpdate.index', compact('customerPaymentUpdates'));
    }
    public function generateNextNumber()
    {   $count  = CustomerPaymentUpdate::get()->count();
        return "PV" . sprintf('%06d', $count + 1);
    }
    public function create()
    {
        $customer = new Customer;
        $customers = Customer::where('customer_type_of_customer', '=', 'credit')
                             ->where('customer_payment_terms', '=', 'credit')->get() ;
        $invoices = [];// not to get invoice numbers without selecting customer
        $next_number = $this->generateNextNumber();
        return view('pages.CustomerPaymentUpdate.create', compact(['customers', 'invoices', 'next_number']));
    }

    // public function currentOutstanding(Request $request)
    // {
    //     $currOutstanding = $request->outstanding_amount - $request->payment_amount;
        
    // }

    public function getCusDetails(Request $request)
    {
        $invoice = Invoice::where('customer_id', $request->customer_id)
                            ->where('payment_terms', '=', 'credit')
                            ->get();
        return[
            'invoice'=>$invoice,
        ];
    }

    public function store(Request $request)
    {
        logger($request->all());

        $this->validate($request,[
            'customer_code'=> 'required',
            'received_amount'=> 'required',
            'received_date'=> 'required',
        ]);


        try {
            DB::beginTransaction();
            $customerObject = new Customer;
                $customer =  Customer::where('id', $request['customer_id'])->first();
                $customer = Customer::find($request->customer_id);
                $received_amount = $request->received_amount;
                if (
                    $customer && $customer->customer_payment_terms == $customerObject::$PAYMENT_TERM_CREDIT
                )
                {
                    $customer->customer_credit_limit = (float) $customer->customer_credit_limit + (float) $received_amount;
                    $customer->save();
                }

        $isCpExist = CustomerPaymentUpdate::where('payment_code', $request->payment_code)->first();
            if ($isCpExist) {
                $data['payment_code'] = $this->generateNextNumber();
            }


            $customerPayment = new CustomerPaymentUpdate;
            $customerPayment->payment_code = $request->payment_code;
            $customerPayment->customer_code = $request->customer_code;
            $customerPayment->customer_id = $request->customer_id;
            $customerPayment->outstanding_amount = $request->outstanding_amount;
            $customerPayment->received_amount = $request->received_amount;
            $customerPayment->invoice_no = $request->invoice_no;
            $customerPayment->reference_no = $request->reference_no;
            $customerPayment->received_date = $request->received_date;
            $customerPayment->created_by = request()->user()->id;
            $customerPayment->save();
        flash()->success("Customer Payment Updated");
        DB::commit();
        return redirect()->back();
            }
catch (Exception $error) {
    logger($error);
    DB::rollback();
    $response['alert-danger'] = $error->getMessage();
    return redirect()->back()->with($response);
}
}
}
