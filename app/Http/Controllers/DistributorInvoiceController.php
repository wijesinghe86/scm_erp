<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\BillType;
use App\Models\Customer;
use App\Models\DistributorDeliveryOrder;
use App\Models\DitributorDeliverOrderItem;
use App\Models\DitributorInvice;
use App\Models\DitributorInviceItem;
use App\Models\Employee;
use App\Models\InvoiceSetting;
use App\Models\Organization;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\TaxCreation;
use App\Models\Warehouse;
use Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PDF;

class DistributorInvoiceController extends Controller
{
    public function all(Request $request)
    {

        $invoices = DitributorInvice::with(['Customer', 'SalesStaff'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                    ->orwhere('payment_terms', 'like', '%' . $request->search . '%')
                    ->orWhere(function ($qr) use ($request) {
                        return $qr->whereHas('SalesStaff', function ($SalesStaff) use ($request) {
                            $SalesStaff->where('employee_name_with_intial', 'like', '%' . $request->search . '%');
                        });
                    })
                    ->orWhere(function ($query) use ($request) {
                        return $query->whereHas('Customer', function ($Customer) use ($request) {
                            $Customer->where('customer_name', 'like', '%' . $request->search . '%');
                        });
                    });
            })
            ->latest()->paginate(50);
        return view('pages.DistributorInvoice.index', compact('invoices'));
    }

    public function new()
    {
        $customer = new Customer;
        $setting =   InvoiceSetting::first();
        $vatRates = TaxCreation::where('tax_code', '=', 'VAT')->first();
        $customers = Customer::all();
        $employees = Employee::all();
        $stockItems = StockItem::all();
        $warehouses = Warehouse::all();
        $organizations = Organization::all();
        $billTypes = BillType::where('type', 'invoice')->get();
        $invoice_number = "";
        // $invoiceOption = $setting->InvoiceOption($invoice_number);
        Cart::session(request()->user()->id)->clear();

        return view('pages.DistributorInvoice.create', compact('customer', 'vatRates', 'customers', 'employees', 'stockItems', 'warehouses', 'billTypes', 'setting', 'invoice_number', 'organizations'));
    }
    public function generateInvoiceNumber(Request $request)
    {
        return DitributorInvice::generateInvoiceNumber($request);
    }
    // public function generateInvoiceNumber(Request $request)
    // {
    //     $invocieCategoryId = data_get($request, 'invoice_category');
    //     $billType = BillType::find($invocieCategoryId);
    //     $invoice_count = DitributorInvice::where('category', $billType->id)->count();
    //     $prefix1 = $billType->billtype_code;
       
    //     return $prefix1 .  sprintf('%06d', $invoice_count + 1);
    // }

    public function generateDeliveryOrderNumber()
    {
        $invoice_count = DistributorDeliveryOrder::get()->count();
        return "DO" . sprintf('%06d', $invoice_count + 1);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'invoice_date' => 'required',
            'payment_terms'=>'required',
            'customer_id' => 'required',
            'employee_id' => 'required',
            'organization_id'=> 'required',
            'date_of_delivery'=> 'required',
            'place_of_supply'=> 'required',
            'grand_total_inword'=> 'required',
        ]);

        try {
            DB::beginTransaction();
            // New Invoice No starts here
            //Remove this.... $request['invoice_number'] = DitributorInvice::generateInvoiceNumber($request);
            // New Invoice No ends here
            $customerObject = new Customer;
            $customer = Customer::find($request->customer_id);
            $subTotal = Cart::session(request()->user()->id)->getSubTotal();
            if (
                $customer && $customer->customer_payment_terms == $customerObject::$PAYMENT_TERM_CREDIT &&
                $request->payment_terms == $customerObject::$PAYMENT_TERM_CREDIT
            ) {
                $customer->customer_credit_limit = (float) $customer->customer_credit_limit - (float) $subTotal;
                $customer->save();
            }

            $request['created_by'] = Auth::id();

            // $setting = InvoiceSetting::first();
            // $request['category'] = $setting->invoice_category;
            // $request['type'] = $setting->invoice_type;
            // $request['option'] = $setting->invoice_option;

            $request['category'] = $request->invoice_category;
            $request['type'] = $request->invoice_type;
            $request['option'] = $request->invoice_option;
            $data = $request->all();
            logger($data);

            $billing = (new DitributorInvice)->calculateTotal(
                $request->invoice_number,
                $request['option'],
                $request->discount_amount,
                $request->discount_type
            );

            $data['vat_rate'] = $billing['vatRate'];
            $data['vat_amount'] = $billing['vat'];
            $data['sub_total'] = $billing['subtotal'];
            $data['net_total'] = $billing['netTotal'];
            $data['discount'] = $billing['discount'];
            $data['grand_total'] = $billing['grandTotal'];



            $customer =  Customer::where('id', $request['customer_id'])->first();

            if ($request->payment_terms == 2 &&  $customer->customer_credit_limit <= $data['sub_total']) {
                throw new Exception("Customer Credit Limit Exceeded");
            }

            // TODO::USE ON THE DUPLICATION
            // $isInvoiceNumberTaken = DitributorInvice::where('invoice_number',  $data['invoice_number'])->first();
            // if ($isInvoiceNumberTaken) {
            //     $data['invoice_number'] = $this->generateInvoiceNumber($request);
            //  Remove this.....}

// This is new code for new invoice number ....start
            $maxRetries = 5;
            $attempt = 0;

do {
    // 🔑 Generate inside loop
    $invoiceNumber = DitributorInvice::generateInvoiceNumber($request);
    $data['invoice_number'] = $invoiceNumber;

    try {
        $invoice = DitributorInvice::create($data);
        break; // ✅ success
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == 23000) { // duplicate
            $attempt++;
            if ($attempt >= $maxRetries) {
                throw new Exception("Invoice number generation failed. Try again.");
            }
        } else {
            throw $e;
        }
    }

} while ($attempt < $maxRetries);
// end .......
            $items =  Cart::session(request()->user()->id)->getContent();
            logger($invoice);
            logger($items);
            foreach ($items as $key => $item) {
                DitributorInviceItem::create([
                    'invoice_id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_number,
                    'item_id' => $item->id,
                    'stock_no' => $item->attributes->stock_no,
                    'description' => $item->name,
                    'uom' => $item->attributes->uom,
                    'location_id' => $item->attributes->location_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->price,
                    'sub_total' => $item->attributes->sub_total,
                    'weight' => $item->attributes->weight,
                    //'item_discount_type' => $item->attributes->item_discount_type,
                    //'item_discount_value' => $item->attributes->item_discount_value,
                    'item_discount_amount' => $item->attributes->item_discount_amount,
                    'total' => $item->attributes->total,
                ]);
                
            }
            $items_grouped_by_location = DitributorInviceItem::where('invoice_number', $invoice->invoice_number)->get()->groupBy('location_id')->toArray();

            foreach ($items_grouped_by_location as $location_id => $items) {
                $delivery_order = new DistributorDeliveryOrder;
                $delivery_order->invoice_number = $invoice->invoice_number;
                $delivery_order->delivery_order_no = $this->generateDeliveryOrderNumber();
                $delivery_order->location_id = $location_id;
                $delivery_order->customer_id = $invoice->customer_id;
                $delivery_order->invoice_date = $invoice->invoice_date;
                $delivery_order->created_by = $request['created_by'];
                $delivery_order->save();

                foreach ($items as $item) {
                    $invoice_item = DitributorInviceItem::where('id', $item['id'])->first();
                    $invoice_item->status = "created";
                    $invoice_item->save();

                    $delivery_order_item = new DitributorDeliverOrderItem;
                    $delivery_order_item->delivery_order_no = $delivery_order->id;
                    $delivery_order_item->invoice_id = $invoice->id;
                    $delivery_order_item->item_id  = data_get($item, 'item_id');
                    $delivery_order_item->stock_no  = data_get($item, 'stock_no');
                    $delivery_order_item->description  = data_get($item, 'description');
                    $delivery_order_item->unit_price  = data_get($item, 'unit_price');
                    $delivery_order_item->discount_amount  = data_get($item, 'item_discount_amount');
                    $delivery_order_item->qty  = data_get($item, 'quantity');
                    $delivery_order_item->created_by = $request['created_by'];
                    $delivery_order_item->uom  = data_get($item, 'uom');
                    $delivery_order_item->location  = data_get($item, 'location_id');
                    $delivery_order_item->sub_total  = data_get($item, 'sub_total');
                    $delivery_order_item->total  = data_get($item, 'total');
                    $delivery_order_item->save();
                }
            }
            Cart::session(request()->user()->id)->clear();
            DB::commit();
            return redirect()->route('distributor_invoices.preview', $invoice->id);
        } catch (Exception $error) {
            logger($error);
            DB::rollback();
            $response['alert-danger'] = $error->getMessage();
            return redirect()->back()->with($response);
        }
    }

    public function cancel($invoice_id)
    {
        $invoices = DitributorInvice::find($invoice_id);
        $invoices->cancel_status = 'cancelled';
        $response['alert-success'] = 'InvoiceCancelled!';
        $invoices->cancel_date = now();
        $invoices->cancelled_by = request()->user()->name;
        $invoices->save();
        return redirect()->route('distributor_invoices.index')->with($response);
    }

    public function preview($invoice_id)
    {
        $response['invoices'] = DitributorInvice::with(['Items', 'Customer'])->find($invoice_id);
        $response['items'] = DitributorInviceItem::where('invoice_number', $invoice_id)->get();
        if ($response['invoices'] == null) {
            return abort(404);
        }
        return view('pages.DistributorInvoice.preview')->with($response);
    }


    public function print($invoice_id)
    {
        $invoices = DitributorInvice::with(['Items', 'Customer'])->find($invoice_id);
        // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($invoices == null) {
            return abort(404);
        }

        // return view('pages.Invoices.pdf', compact('invoices'));

        // $view_path = "pages.DistributorInvoice.pdf";
        // logger(config('services.project_name'));
        // if (config('services.project_name') == "jsi_erp") {
        //     $view_path = "pages.Invoices.jsi_pdf";
       
        // }
        $pdf = PDF::loadView("pages.DistributorInvoice.pdf", compact('invoices'))->setPaper('A4', 'portrait');
        $invoices->status = 'printed';
        $invoices->save();
        return $pdf->stream('invoice.pdf');
    }

    public function storeItem(Request $request)
    {
        $stock = Stock::where('stock_item_id', $request['id'])->where('warehouse_id', $request['attributes']['location_id'])->first();
        $warehouse = Warehouse::find($request['attributes']['location_id']);
        if (!$stock) {
            throw ValidationException::withMessages(['item' => "Stock Record not found"]);
        }

        $cartItem = Cart::session(request()->user()->id)->get($request['id']);

        if ($cartItem) {
            $newQty = $request['quantity'] + $cartItem['quantity'];
            if ($stock->qty < $newQty) {
                throw ValidationException::withMessages(['item' => "Item quantity exceed the stock in hand"]);
            }
        }
        Cart::session(request()->user()->id)->add($request->all());
        return $this->cartList();
    }

    public function deleteItem(Request $request)
    {
        $invoiceItem = DitributorInviceItem::where('id', $request->cartData['id'])->first();
        $invoiceItem->delete();
        return;
    }

    public function itemsTable(Request $request)
    {
        $cartCollection =  Cart::session(request()->user()->id)->getContent();
        $items = $cartCollection->sortBy(function ($product, $key) {
            return $key;
        });

        return view('pages.DistributorInvoice.items_table', compact('items'));
    }

    public function getData(Request $request)
    {
        $invoices = DitributorInvice::find($request->invoice_id);
        return $invoices;
    }

    public function getInvoiceTotal(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required'
        ]);
        $option =  $request->option;
        $discount_amount =  $request->discount_amount ?? 0;
        $discount_type =  $request->discount_type ?? "fixed";
        $data = (new DitributorInvice)->calculateTotal($request->invoice_no, $option, $discount_amount, $discount_type);
        return $data;
    }



    public function cartList()
    {
        $cartCollection =  Cart::session(request()->user()->id)->getContent();
        $sorted = $cartCollection->sortBy(function ($product, $key) {
            return $key;
        });
        $subTotal = Cart::session(request()->user()->id)->getSubTotal();
        $total = Cart::session(request()->user()->id)->getTotal();
        return [
            'cart' => $sorted->toArray(),
            'subTotal' => $subTotal,
            'total' => $total
        ];
    }
}


