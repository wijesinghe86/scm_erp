<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\UrgentInvoice;
use App\Models\UrgentDelivery;
use App\Models\UrgentDeliveryItem;
use App\Models\UrgentInvoiceItem;
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
        return view ('pages.UrgentInvoice.create', compact(
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
        'invoice_number'=> 'required',
         'items'=> 'required|array',
        'items.*.unit_rate'=> 'required',

        ]);
    // $totals = $this->calculateTotal();



    // public function calculateTotal($option, $items){
    //     return [

    //     ];
    // }




        $urgentInvoice = new UrgentInvoice();
        $urgentInvoice->invoice_number = $request->invoice_number;
        $urgentInvoice->invoice_date =$request->invoice_date;
        $urgentInvoice->delivery_order_id =$request->delivery_order_no;
        $urgentInvoice->customer_id =$request->customer_id;
        $urgentInvoice->payment_terms = $request->payment_terms;
        $urgentInvoice->credit_days = $request->credit_days;
        $urgentInvoice->sales_employee_id = $request->employee_id;
        $urgentInvoice->ref_number = $request->ref_number;
        $urgentInvoice->po_number = $request->po_number;
        $urgentInvoice->category = $request->invoice_category;
        $urgentInvoice->type = $request->invoice_type;
        $urgentInvoice->option = $request->invoice_option;
        $urgentInvoice->warehouse_id = $request->warehouse_id;
        //$urgentInvoice->sub_total = $request->
    //     $urgentInvoice->vat_rate = $request->
    //     $urgentInvoice->vat_amount = $request->
    //     $urgentInvoice->net_total = $request->
    //     $urgentInvoice->total_item_discount = $request->
    //    $urgentInvoice->grand_total = $request->

        $urgentInvoice->save();

        foreach ($request->items as $item)
          // logger($request->items);
            $urgentInvoiceItems = new UrgentInvoiceItem;
            $urgentInvoiceItems->invoice_id = $item['invoice_id'];
            $urgentInvoiceItems->item_id = $item['item_id'];
            $urgentInvoiceItems->invoice_quantity = $item['issued_qty'];
            $urgentInvoiceItems->unit_price = $item['unit_rate'];
            $urgentInvoiceItems->weight = $item['weight'];
            $urgentInvoiceItems->item_discount_type = $item['discount_type'];
            $urgentInvoiceItems->item_discount_value = $item['discount_amount'];
            //$urgentInvoiceItems->item_value = $item['itemTotal'];
            $urgentInvoiceItems->save();


   // session(['mr.items'=>[]]); // clear the session
    flash('Invoice Created')->success();
   // return redirect()->route('material_request.index');




    }

    // public function getInvoiceTotal(Request $request)
    // {
    //     $this->validate($request, [
    //         'invoice_number' => 'required'
    //     ]);
    //     $option =  $request->invoice_option;
    //     $discount_amount =  $request->items['discount_amount'] ?? 0;
    //     $discount_type =  $request->items['discount_type'] ?? "fixed";
    //     $data = (new UrgentInvoice)->calculateTotal($request->invoice_number, $option, $discount_amount, $discount_type);
    //     return $data;
    // }


}
