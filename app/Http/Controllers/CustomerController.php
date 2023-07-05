<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ParentController;

class CustomerController extends ParentController
{
    public function generateNextNumber()
    {
        $count  = Customer::get()->count();
        return "CUS" . sprintf('%05d', $count + 1);
    }


    // public function getNextCustomerNumber()
    // {
    //     $last_cu =  Customer::latest()->first();
    //     $last_cu_number = 0;
    //     if ($last_cu != null) {
    //         $last_cu_number = $last_cu->id;
    //     }
    //     return "CUS" . sprintf("%05d", $last_cu_number + 1);
    // }

    public function index()
    {
        $customers = Customer::get();
        return view('pages.Customer.index', compact('customers'));
    }

    public function create()
    {
        $customer = new Customer;
        $next_number = $this->generateNextNumber();
        return view('pages.Customer.create', compact('next_number', 'customer'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_code' => 'required',
            'customer_name' => 'required',
            'customer_type_of_customer' => 'required',
            'customner_vat_number'=>'required',
            'customer_payment_terms' => 'required',
            'customer_address_line1'=>'required',
            'customer_address_line2'=>'required',
            'customer_mobile_number'=>'required',

        ]);
            $isCusExist = Customer::where('customer_code', $request->customer_code)->first();
            if ($isCusExist) {
                $data['customer_code'] = $this->generateNextNumber();
            }

        $request['created_by'] = Auth::id();
        Customer::create($request->all());



        $response['alert-success'] = 'New Customer created successfully!';
        return redirect()->route('customer.index')->with($response);

        }




    public function edit($customer_id)
    {
        $customers = Customer::find($customer_id);
        return view('pages.Customer.edit', compact('customers'));
    }

    public function update(Request $request, $customer_id)
    {
        $customers = Customer::find($customer_id);
        $request['updated_by'] = Auth::id();
        $customers->update($request->all());

        $response['alert-success'] = 'Customer updated successfully!';
        return redirect()->route('customer.index')->with($response);
    }

    public function delete($customer_id)
    {
        $customers = Customer::find($customer_id);
        $customers->deleted_by = Auth::id();
        $customers->save();
        $customers->delete();

        $response['alert-success'] = 'Customer deleted successfully!';
        return redirect()->route('customer.index')->with($response);
    }

    public function deleted()
    {
        $response['customers'] = Customer::onlyTrashed()->get();
        return view('pages.Customer.deleted')->with($response);
    }
    public function restore($customer_id)
    {
        $customers = Customer::withTrashed()->find($customer_id);
        $customers->restore();

        $response['alert-success'] = 'Customer restored successfully!';
        return redirect()->route('customer.deleted')->with($response);
    }
    public function deleteForce($customer_id)
    {
        $customers = Customer::withTrashed()->find($customer_id);
        $customers->forceDelete();

        $response['alert-success'] = 'Customer restored successfully!';
        return redirect()->route('customer.deleted')->with($response);
    }

    public function view($customer_id)
    {
        $response['customers'] = Customer::find($customer_id);
        return view('pages.Customer.view')->with($response);
    }
    public function active($customer_id)
    {
        $customers = Customer::find($customer_id);
        $customers->customer_status = 1;
        $customers->save();
        $response['alert-success'] = 'Customer activated successfully';
        return redirect()->back()->with($response);
    }

    public function deactive($customer_id)
    {
        $customers = Customer::find($customer_id);
        $customers->customer_status = 0;
        $customers->save();
        $response['alert-success'] = 'Customer deactivated successfully';
        return redirect()->back()->with($response);
    }

    public function print()
    {
        $response['customers'] = Customer::all();
        $pdf = PDF::loadview('pages.print.customerIndex', $response);
        // return $pdf->download('customers.pdf');
        return $pdf->stream('customers.pdf', array("Attachment" => false));
    }

    public function getData(Request $request)
    {
        $customers = Customer::find($request->customer_id);
        return $customers;
    }
}
