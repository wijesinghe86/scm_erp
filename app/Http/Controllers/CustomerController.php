<?php

namespace App\Http\Controllers;
Use PDF;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ParentController;

class CustomerController extends ParentController
{
    public function index()
    {
        $customers = Customer::get();
        return view('pages.Customer.index', compact('customers'));

    }

    public function create()
    {
        $last_cu =  Customer::latest()->first();
        $last_cu_number = 0;
        if($last_cu != null){
           $last_cu_number = $last_cu->id;
        }
        $next_number = "CUS".sprintf("%05d", $last_cu_number+1);
        return view ('pages.Customer.create', compact('next_number'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request['created_by'] = Auth::id();
        Customer::create($request->all());


        $response['alert-success'] = 'New Customer created successfully!';
        return redirect()->route('customer.index')->with($response);
    }

        public function edit($customer_id)
        {
            $response['customers']=Customer::find($customer_id);
            //dd($response);
            return view('pages.Customer.edit')->with($response);
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
            return view('pages.Customer.view')->with ($response);

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
        return $pdf->stream('customers.pdf', array("Attachment"=>false));

    }

    public function getData(Request $request)
    {
        $customers = Customer::find($request->customer_id);
        return $customers;
    }


    }


