<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UrgentCreditNote;
use App\Models\UrgentCreditNoteItem;
use App\Models\UrgentInvoice;
use App\Models\UrgentReturn;
use App\Models\UrgentReturnItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReverseCreditNoteController extends Controller
{
    public function index(Request $request)
    {
        $creditNotes = UrgentCreditNote::with(['customer', 'invoice', 'createuser'])
            ->when($request->search, function($q) use ($request){
                $q->where('credit_note_no', 'like', '%' . $request->search. '%')
                // ->orwhere('payment_terms', 'like', '%' . $request->search. '%')
                ->orWhere(function ($qr) use ($request){
                    return $qr->whereHas('invoice', function ($invoice) use ($request){
                    $invoice->where('invoice_number', 'like', '%' . $request->search . '%');
                });
                  })
                  ->orWhere(function ($qr) use ($request){
                    return $qr->whereHas('createuser', function ($createuser) use ($request){
                    $createuser->where('name', 'like', '%' . $request->search . '%');
                });
                  })
                  ->orWhere(function ($query) use ($request){
                        return $query->whereHas('customer', function ($customer) use ($request){
                            $customer->where('customer_name', 'like', '%' . $request->search . '%');
            });
        });
    })
            ->latest()->paginate(50);
            return view ('pages.ReverseCreditNote.index', compact('creditNotes'));

        // $creditNotes = Creditnote::with(['items', 'invoice'])->get();
        // return view ('pages.CreditNote.index', compact('creditNotes'));
    }
    public function generateNextNumber()
    {   $count  = UrgentCreditNote::get()->count();
        return "JTF-RCN" . sprintf('%06d', $count + 1);
    }

    public function create(Request $request)
    {   $urgent_invoices = UrgentInvoice::with(['customer'])
        ->get();
        $rmrs = []; //not loading mrs no without selecting invoice
        //$creditNote = new Creditnote();
        $next_number = $this->generateNextNumber();
        return view ('pages.ReverseCreditNote.create', compact('urgent_invoices', 'rmrs', 'next_number'));
    }

    
 
    public function getInvDetails(Request $request)
    {
        try {
            $invoice = UrgentInvoice::with('customer')
                ->find($request->invoice_id);
    
            if (!$invoice) {
                return response()->json([
                    'error' => 'Invoice not found'
                ], 404);
            }
    
            if (!$invoice->customer) {
                return response()->json([
                    'error' => 'Customer not found for this invoice'
                ], 404);
            }
    
            // Get MRS (returns)
            $rmrs = UrgentReturn::where('invoice_id', $invoice->id)->get();
    
            return response()->json([
                'invoice_date' => $invoice->invoice_date,
                'customer' => [
                    'customer_code' => $invoice->customer->customer_code,
                    'customer_name' => $invoice->customer->customer_name,
                    'vat_no' => $invoice->customer->customer_vat_number,
                ],
                'mrs' => $rmrs
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    
}
    public function getReturn(Request $request){
    // {
    //     $rmrs_list = UrgentReturnItem::with(['stock_item', 'material_return.get_invoice'])
    //                 ->where('return_id', $request->return_id)
    //                 ->get(); 
    //                 logger($rmrs_list->pluck('stock_item.stock_number'));
    //     return view('pages.ReverseCreditNote.returnitems', compact('rmrs_list'));
    // }
   
    $rmrs_list = UrgentReturnItem::with(['stock_item', 'material_return.get_invoice'])
        ->where('return_id', $request->return_id)
        ->get()
        ->map(function ($item) {
            $item->option = optional($item->material_return->get_invoice)->option;
            return $item;
        });

    return view('pages.ReverseCreditNote.returnitems', compact('rmrs_list'));
}
    
    public function store(Request $request){

        logger($request->all());
    $this->validate($request,[
    'invoice_no'=> 'required',
    'items'=> 'required|array',
    'items.*.creditQty'=> 'required',
]);
        $isCnExist = UrgentCreditNote::where('credit_note_no', $request->credit_note_no)->first();
            if ($isCnExist) {
                $data['credit_note_no'] = $this->generateNextNumber();
            }



            $creditnote = new UrgentCreditNote;
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

            $credit_Note_items = new UrgentCreditNoteItem;
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


