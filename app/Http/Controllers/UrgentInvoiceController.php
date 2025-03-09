<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\UrgentInvoice;
use App\Models\UrgentDelivery;
use App\Models\UrgentDeliveryItem;
use App\Models\Warehouse;

class UrgentInvoiceController extends Controller
{
    public function index() {}

    public function generateInvoiceNumber(Request $request)
    {
        $invoice_category = data_get($request, 'invoice_category');
        $billType = BillType::find($invoice_category);
        $invoice_count = UrgentInvoice::where('category', $billType->id)->count();
        $prefix = $billType->billtype_code;
        return $prefix . sprintf('%06d', $invoice_count + 1);
    }

    public function create()
    {
        $customer = new Customer;

        $warehouses = Warehouse::get();
        $customers = Customer::all();
        $employees = Employee::all();
        $urgentDeliveries = UrgentDelivery::with(['get_customer', 'items.item'])->get();
        $billTypes = BillType::where('type', 'urgent')->get();
        $customerTerms = json_encode($customer::$PAYMENT_TERMS);
        $customerCreditPeriod = json_encode($customer::$CREDIT_PERIODS);
        return view('pages.UrgentInvoice.create', compact(
            'urgentDeliveries',
            'billTypes',
            'customers',
            'employees',
            'warehouses',
            'customerTerms',
            'customerCreditPeriod'
        ));
    }
    public function store(Request $request)
    {
        logger($request->all());
        $request->validate([
            'invoice_number' =>  'required',
            'items'=> 'required|array',
            'items.*.unit_rate'=> 'required'
        ]);
        // $totals = $this->calculateTotal();
        
    }

    public function calculateTotal($option, $items){
        return [

        ];
    }
}
