<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Employee;
// use App\Models\Item;
use App\Models\Warehouse;
use App\Models\InvoiceItem;
use App\Models\TaxCreation;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\InvoiceSetting;
use App\Models\StockItem;
use App\Models\DeliveryOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;


class InvoiceController extends ParentController
{
    public function all()
    {
        $response['invoices'] = Invoice::all();
        return view('pages.Invoices.all')->with($response);
    }

    public function new()
    {
        $invoiceSettings =   InvoiceSetting::first();
        $response['vatRates'] = TaxCreation::where('tax_code', '=', 'VAT')->first();
        $response['customers'] = Customer::all();
        $response['employees'] = Employee::all();
        $response['stockItems'] = StockItem::all();
        $response['warehouses'] = Warehouse::all();
        $response['setting'] = $invoiceSettings;
        $response['invoice_number'] = $this->generateInvoiceNumber();
        $response['invoiceOption'] = $invoiceSettings->InvoiceOption($response['invoice_number']);
        // $response['invoiceData'] =  $this->getInvoiceTotal($request);

        return view('pages.Invoices.new')->with($response);
    }

    public function generateInvoiceNumber()
    {
        $setting = InvoiceSetting::first();
        $first_letter = $setting->category ? $setting->category->billtype_code : '';
        $invoice_count = Invoice::where('category', $setting->invoice_category)->count();
        return $first_letter . sprintf('%06d', $invoice_count + 1);
    }

    public function generateDeliveryOrderNumber()
    {
        $invoice_count = DeliveryOrder::get()->count();
        return "DO" . sprintf('%06d', $invoice_count + 1);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'po_number' => 'required',
            'invoice_date' => 'required',
            'ref_number' => 'required',
            'customer_id' => 'required',
            'employee_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $request['created_by'] = Auth::id();

            $setting = InvoiceSetting::first();
            $request['category'] = $setting->invoice_category;
            $request['type'] = $setting->invoice_type;
            $request['option'] = $setting->invoice_option;

            $data = $request->all();

            $billing = (new Invoice)->calculateTotal(
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

            if ($request->payment_terms == 2 &&  $customer->customer_credit_limit < $data['grand_total']) {
                throw new Exception("Customer Credit Limit Exceeded");
            }

            $invoice = Invoice::create($data);

            $items_grouped_by_location = InvoiceItem::where('invoice_number', $invoice->invoice_number)->get()->groupBy('location_id')->toArray();

            foreach ($items_grouped_by_location as $location_id => $items) {
                $delivery_order = new DeliveryOrder;
                $delivery_order->invoice_number = $invoice->invoice_number;
                $delivery_order->delivery_order_no = $this->generateDeliveryOrderNumber();
                $delivery_order->location_id = $location_id;
                $delivery_order->customer_id = $invoice->customer_id;
                $delivery_order->invoice_date = $invoice->invoice_date;
                $delivery_order->created_by = $request['created_by'];
                $delivery_order->save();


                foreach ($items as $item) {
                    $invoice_item = InvoiceItem::where('id', $item['id'])->first();
                    $invoice_item->status = "created";
                    $invoice_item->save();

                    $delivery_order_item = new DeliveryOrderItem;
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


                    // TODO:Reduce Stock
                }
            }
            DB::commit();
            return redirect()->route('invoices.preview', $invoice->id);
        } catch (Exception $error) {
            logger($error);
            DB::rollback();
            $response['alert-danger'] = $error->getMessage();
            return redirect()->back()->with($response);
        }
    }

    public function preview($invoice_id)
    {
        $response['invoices'] = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        $response['items'] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($response['invoices'] == null) {
            return abort(404);
        }
        return view('pages.Invoices.preview')->with($response);
    }


    public function print($invoice_id)
    {
        $invoices = Invoice::with(['Items', 'Customer'])->find($invoice_id);
        // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($invoices == null) {
            return abort(404);
        }
        $pdf = PDF::loadView('pages.invoices.pdf', compact('invoices'));
        return $pdf->stream('invoice.pdf');
    }

    public function storeItem(Request $request)
    {
        // $customer = Customer::find($request->customer_id);

        // $invoice_total = InvoiceItem::where('invoice_number', $request->invoice_no)->sum('total');
        // $new_total = $invoice_total + ($request->quantity * $request->unit_price) - (($request->quantity * $request->unit_price) * ($request->item_discount_percentage/100));

        // if($customer->customer_credit_limit < $new_total)
        // {
        //     return response()->json(['status'=>0, 'message' =>'Customer credit limit exceeded ']);
        // }
        // else
        // {

        $this->validate($request, [
            'location_id' => 'required'
        ]);

        $item = StockItem::find($request->item_id);
        InvoiceItem::create([
            'invoice_number' => $request->invoice_no,
            'item_id' => $request->item_id,
            'stock_no' => $item->stock_number,  //from stockitem table
            'description' => $item->description,  //from stockitem table
            'uom' => $item->unit,  //from stockitem table
            'location_id' => $request->location_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'sub_total' => $request->quantity * $request->unit_price,
            'item_discount_percentage' => $request->item_discount_percentage ?? 0,
            'item_discount_amount' => $request->item_discount_amount ?? 0,
            'total' => ($request->quantity * $request->unit_price) - (($request->quantity * $request->unit_price) * ($request->item_discount_percentage / 100)),
        ]);

        //     return response()->json(['status' =>1, 'message' => 'Item added to invoice']);
        // }
    }

    public function deleteItem(Request $request)
    {
        $invoiceItem = InvoiceItem::where('id', $request->cartData['id'])->first();
        $invoiceItem->delete();
        return;
    }

    public function itemsTable(Request $request)
    {
        $response['items'] = InvoiceItem::where('invoice_number', $request->invoice_no)->get();
        // $response['item_count'] = InvoiceItem::where('invoice_number', $request->invoice_no)->count();
        // $response['total_qty'] = InvoiceItem::where('invoice_number', $request->invoice_no)->sum('quantity');
        // $response['total_amount'] = InvoiceItem::where('invoice_number', $request->invoice_no)->sum('total');
        // $response['grand_total'] = InvoiceItem::where('invoice_number', $request->invoice_no)->sum('total');


        return view('pages.Invoices.components.items_table')->with($response);
    }

    public function getData(Request $request)
    {
        $invoices = Invoice::find($request->invoice_id);
        return $invoices;
    }

    public function getInvoiceTotal(Request $request)
    {
        $this->validate($request, [
            'invoice_no' => 'required'
        ]);
        $option =  $request->option ?? "Option A";
        $discount_amount =  $request->discount_amount ?? 0;
        $discount_type =  $request->discount_type ?? "fixed";

        return (new Invoice)->calculateTotal(
            $request->invoice_no,
            $option,
            $discount_amount,
            $discount_type
        );
    }
}
