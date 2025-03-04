<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\UrgentInvoice;
use App\Models\UrgentDelivery;
use App\Models\UrgentDeliveryItem;

class UrgentInvoiceController extends Controller
{
    public function index()
    {

    }

    // public function generateNextNumber()
    // {
    //     $count  = UrgentInvoice::get()->count();
    //     return "UIN" . sprintf('%04d', $count + 1);
    // }

    public function generateInvoiceNumber(Request $request)
    {
        $invocieCategoryId = data_get($request, 'invoice_category');
        $billType = BillType::find($invocieCategoryId);
        $invoice_count = UrgentInvoice::where('category',$billType->id)->count();
        $prefix = $billType->billtype_code;

        return $prefix . sprintf('%06d', $invoice_count + 1);
    }

    public function create()
    {
        $customer = new Customer;
        $employees = Employee::all();
        $urgent_invoice = UrgentInvoice::get();
        $urgent_delivery = UrgentDelivery::with ('get_customer')->get();
        //$next_number = $this->generateNextNumber();
        $billTypes = BillType::where('type','urgent')->get();

        $do_list = UrgentDeliveryItem::with('item')->get();
        return view('pages.UrgentInvoice.create', compact('urgent_invoice', 'urgent_delivery', 'billTypes','customer', 'employees', 'do_list' ));
    }

    public function getIsuuedItems(Request $request){
        $list =  UrgentDeliveryItem::with('item')
                ->where('delivery_order_id', $request->delivery_order_id)
                ->get();

                // get
                // $items =  session('urgentInvoice.items') ?? [];

                // set
                // session(['mr.items'=>$items]);
                session(['urgentInvoice.items'=>$list]);
        return view('pages.UrgentInvoice.urgent_do_table');
    }

    public function store(Request $request)
    {

    }

public function syncCalculations(Request $request){
    // return (new UrgentInvoice)->syncCalculations($request->option,$request->discount_value,$request->discount_type);

    $items =  session('urgentInvoice.items') ?? [];

    //Test
    $grandTotal = collect($items)->reduce(function ($carry, $item) {
        return $carry + $item->issued_qty;
    }, 0);
    
    return [
        "grandTotal" => $grandTotal,
    ];
}
}
