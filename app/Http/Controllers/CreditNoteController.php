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

class CreditNoteController extends Controller
{
    public function index()
    {
        return view ('pages.CreditNote.index');
    }
    public function generateNextNumber()
    {   $count  = Creditnote::get()->count();
        return "CN" . sprintf('%06d', $count + 1);
    }

    public function create(Request $request)
    {   $invoices = Invoice::with(['customer'])->get();
        $mrs = InvoiceReturn::get();
        $balanceOrders = BalanceOrder::where('is_issued',  '=','0')->get();
        $deliveryOrders = DeliveryOrder::where('issued_date','=', null)->get();
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
        $do_list = DeliveryOrderItem::with('stock_item')
                    ->where('delivery_order_no', $request->delivery_order_no)
                    ->get();
        return view('pages.CreditNote.notissueditem', compact('do_list'));
    }

    public function getReturn(Request $request)
    {
        $mrs_list = InvoiceReturnItem::with('stock_item')
                    ->where('return_id', $request->return_id)
                    ->get();
        return view('pages.CreditNote.returnitems', compact('mrs_list'));
    }

    public function getBalanceItems(Request $request)
    {
        $bo_list = BalanceOrderItem::with('stock_item')
                    ->where('balance_order_id', $request->balance_order_id)
                    ->get();
        return view('pages.CreditNote.balanceitem', compact('bo_list'));
    }

    public function store(){
        $isCnExist = Creditnote::where('credit_note_no', $request->credit_note_no)->first();
            if ($isCnExist) {
                $data['credit_note_no'] = $this->generateNextNumber();
            }

    }
}
