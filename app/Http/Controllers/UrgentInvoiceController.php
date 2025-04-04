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
use Illuminate\Validation\ValidationException;

class UrgentInvoiceController extends Controller
{
    public $vatRate = 18;
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
        $urgentDeliveries = UrgentDelivery::with(['get_customer', 'items.item'])
        ->doesntHave('urgent_invoice_items')->get();
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
        //logger($request->all());
        $request->validate([
        'invoice_number'=> 'required|unique:'.UrgentInvoice::class,
        'items'=> 'required|array',
        'items.*.unit_rate'=> 'required',

        ]);




        $subTotal = $this->getSubTotal($request);

        logger($request->all());
        //check credit limit

        if($request->payment_terms == 'credit' && $subTotal > $request->customer['customer_credit_limit']){
            throw ValidationException::withMessages(["customer"=> 'Credit limit exceeded']);
        }

        $totalItemListDiscount = $this->getTotalItemListDiscount($request);
        $vatAmount = $this->getVatAmount($request);
        $netTotal = $this->getNetTotal($request);
        $mainDiscount = $this->getMainDiscount($request);
        $totalDicountAmount = $totalItemListDiscount +$mainDiscount;
        $grandTotal = $this->getGrandTotal($request);
        // logger("totalItemListDiscount");
        // logger($totalItemListDiscount);
        // logger("subTotal");
        // logger($subTotal);
        // logger("vatAmount");
        // logger($vatAmount);
        // logger("netTotal");
        // logger($netTotal);
        // logger("mainDiscount");
        // logger($mainDiscount);
        // logger("totalDicountAmount");
        // logger($totalDicountAmount);
        // logger("grandTotal");
        // logger($grandTotal);
        return
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
        $urgentInvoice->sub_total = $subTotal;
        $urgentInvoice->vat_rate = $this->vatRate;
        $urgentInvoice->vat_amount = $vatAmount;
        $urgentInvoice->net_total = $netTotal;
        $urgentInvoice->total_item_discount = $totalItemListDiscount;
        $urgentInvoice->grand_total = $grandTotal;
        $urgentInvoice->save();

        foreach ($request->items as $item)
          //logger($request->items);
            $urgentInvoiceItems = new UrgentInvoiceItem;
            $urgentInvoiceItems->invoice_id = $item['invoice_id'];
            $urgentInvoiceItems->item_id = $item['item_id'];
            $urgentInvoiceItems->invoice_quantity = $item['issued_qty'];
            $urgentInvoiceItems->unit_price = $item['unit_rate'];
            $urgentInvoiceItems->weight = $item['weight'];
            $urgentInvoiceItems->item_discount_type = $item['discount_type'];
            $urgentInvoiceItems->item_discount_value = $item['discount_amount'];
            //$urgentInvoiceItems->item_value = $item['unit_rate']*$item['issued_qty']-$item['discount_amount'];
            $urgentInvoiceItems->save();


   // session(['mr.items'=>[]]); // clear the session
    flash('Invoice Created')->success();
   // return redirect()->route('material_request.index');




    }

    public function getTotalItemListDiscount($request){
        $tempDiscount = 0;
        foreach($request->items  as $item){
            $itemAmount = (float) $item['issued_qty'] * (float) $item['unit_rate'] ?? 0;

            $tempItemDiscount = 0;
            if($item['discount_type'] == "fixed"){
                $tempItemDiscount = $item['discount_amount'] ?? 0;
            }

            if($item['discount_type'] == "percentage"){
                $tempItemDiscount = $itemAmount * $item['discount_amount']  /100;
            }
            $tempDiscount += $tempItemDiscount;
        }

        return $tempDiscount;
    }

    public function getSubTotal($request){
        $tempSubTotal = 0;
        foreach($request->items  as $item){
            $itemAmount = $item['issued_qty'] *$item['unit_rate'] ?? 0;
            $tempSubTotal += $itemAmount;
        }
        return $tempSubTotal;
    }

    public function getVatAmount($request){
        if($request->invoice_option == '0'){
           return 0;
        }
        if($request->invoice_option == '2'){
            $excludeVat = $this->getSubTotal($request)/ ((100+$this->vatRate)/100);
            return $excludeVat * ($this->vatRate/100);
        }
        return $this->getSubTotal($request) * ($this->vatRate /100);
    }

    public function getNetTotal($request){
       return $this->getSubTotal($request)+ $this->getVatAmount($request);
    }

    public function getMainDiscount($request){
        $mainDiscountAmount =0;
        if($request->mainDiscountType == 'percentage'){
            $mainDiscountAmount - $this->getNetTotal($request) * ($request->mainDiscount ?? 0)/100;
        }
        if($request->mainDiscountType == 'fixed'){
            $mainDiscountAmount - $request->mainDiscount ?? 0;
        }
        return $mainDiscountAmount;
    }

    public function getGrandTotal($request){
        return $this->getNetTotal($request) - ($this->getTotalItemListDiscount($request) + $this->getMainDiscount($request));
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
