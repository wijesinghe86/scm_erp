<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Creditnote;
use App\Models\BalanceOrder;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\InvoiceReturn;
use App\Models\BalanceOrderItem;
use App\Models\DeliveryOrderItem;
use App\Models\InvoiceReturnItem;
use App\Models\credit_note_item_table;

class CreditNoteController extends Controller
{
    public function index()
    {   $creditNotes = Creditnote::with(['items', 'invoice'])->get();
        return view ('pages.CreditNote.index', compact('creditNotes'));
    }
    public function generateNextNumber()
    {   $count  = Creditnote::get()->count();
        return "JTF-CN" . sprintf('%06d', $count + 1);
    }

    public function create(Request $request)
    {   $invoices = Invoice::with(['customer'])->get();
        $mrs = []; //not loading mrs no withour selecting invoice
        $balanceOrders = [];//not loading balance orders no without selecting invoice
        $deliveryOrders = [];//not loading delivery orders no without selecting invoice
        $creditNote = new Creditnote();
        $next_number = $this->generateNextNumber();
        return view ('pages.CreditNote.create', compact('invoices', 'mrs', 'balanceOrders', 'deliveryOrders', 'next_number'));
    }

    public function getInvDetails(Request $request){
        $mrs = InvoiceReturn::where('invoice_id', $request->invoice_id)->get();
        $balanceOrders = BalanceOrder::where('is_issued',  '=','0')
        ->where('invoice_number', $request->invoice_number)
        ->get();
        $deliveryOrders = DeliveryOrder::where('issued_date','=', null)
        ->where('invoice_number', $request->invoice_number)
        ->get();
        return[
            'mrs'=>$mrs,
            'balanceOrders'=>$balanceOrders,
            'deliveryOrders'=>$deliveryOrders,
        ];
    }

    public function nonIssues(Request $request)
    {
        $do_list = DeliveryOrderItem::with(['stock_item','delivery_order.invoice'])
                    ->where('delivery_order_no', $request->delivery_order_no)
                    ->get();
        return view('pages.CreditNote.notissueditem', compact('do_list'));
    }

    public function getReturn(Request $request)
    {
        $mrs_list = InvoiceReturnItem::with(['stock_item', 'material_return.invoice'])
                    ->where('return_id', $request->return_id)
                    ->get();
        return view('pages.CreditNote.returnitems', compact('mrs_list'));
    }

    public function getBalanceItems(Request $request)
    {
        $bo_list = BalanceOrderItem::with(['stock_item', 'balance_order.invoice'])
                    ->where('balance_order_id', $request->balance_order_id)
                    ->get();
        return view('pages.CreditNote.balanceitem', compact('bo_list'));
    }

    public function store(Request $request){

        logger($request->all());
    $this->validate($request,[
    'invoice_no'=> 'required',
    'items'=> 'required|array',
    'items.*.creditQty'=> 'required',
]);
        $isCnExist = Creditnote::where('credit_note_no', $request->credit_note_no)->first();
            if ($isCnExist) {
                $data['credit_note_no'] = $this->generateNextNumber();
            }



            $creditnote = new Creditnote;
            $creditnote->invoice_no = $request->invoice_no;
            $creditnote->credit_note_date = now();
            $creditnote->credit_note_no = $request->credit_note_no;
            $creditnote->customer_code = $request->customer_code;
            $creditnote->hand_chit_date = $request->hand_chit_date;
            $creditnote->less_invoice_no = $request->less_invoice_no;
            $creditnote->reference_type = $request->reference_type;
            $creditnote->reference_no = $request->reference_no;
            $creditnote->grand_total = $request->grand_total;
            $creditnote->created_by = request()->user()->id;
            $creditnote->save();

            $filter_is_selected = collect($request->items)->filter(function ($row) {
                return isset($row['is_selected']);
            });
            if (count($filter_is_selected) == 0) {
                throw ValidationException::withMessages(['items' => "The items list cannot be empty"]);
            }


    foreach ($request->items as $row) {
            if (!isset($row['is_selected'])) {
                continue;
            }

            $credit_Note_items = new credit_note_item_table;
            $credit_Note_items->credit_note_no = $creditnote->id;
            $credit_Note_items->stock_no = data_get($row,'stock_item_id');
            $credit_Note_items->credit_qty = data_get($row,'creditQty');
            $credit_Note_items->unit_rate =  data_get($row,'stock_item_unit_price');
            $credit_Note_items->sales_value = data_get($row,'saleValue');
            $credit_Note_items->vat_amount = data_get($row,'vatAmount');
            $credit_Note_items->total_sales_value = data_get($row,'totalValue');
            $credit_Note_items->save();
    }
    flash()->success("New Credit Note Created");
        return redirect()->back();

}

}
