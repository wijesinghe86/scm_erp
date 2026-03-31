<?php

namespace App\Http\Controllers;

use table;
use App\Models\Invoice;
use App\Models\Creditnote;
use App\Models\credit_note_item_table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessCreditNoteController extends Controller
{
    public function index(Request $request)
    {
        $creditNotes = Creditnote::with(['customer', 'invoice', 'createuser'])
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
            return view ('pages.LessInvoiceCreditNote.index', compact('creditNotes'));

        // $creditNotes = Creditnote::with(['items', 'invoice'])->get();
        // return view ('pages.CreditNote.index', compact('creditNotes'));
    }
    public function generateNextNumber()

    {   
        $count  = Creditnote::get()->count();
        return "JTF-CN" . sprintf('%06d', $count + 1);
    }

    public function create(Request $request)
    {   $invoices = Invoice::with(['customer'])
        ->get();
        $creditNote = new Creditnote();
        $next_number = $this->generateNextNumber();
        return view ('pages.LessInvoiceCreditNote.create', compact('invoices','next_number'));
    }

    
    public function store(Request $request){

//     logger($request->all());
//     $this->validate($request,[
//     'invoice_no'=> 'required',
    
// ]);
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
            $creditnote->grand_total = $request->invoice_amount;
            $creditnote->less_amount = $request->less_amount;
            $creditnote->reference_type = 'lesscredit';
            $creditnote->reference_no = 'lesscredit';
            $creditnote->less_invoice_amount = $request->less_invoice_amount;
            $creditnote->created_by = request()->user()->id;
            $creditnote->save();

            $credit_Note_items = new credit_note_item_table;
            $credit_Note_items->credit_note_no = $creditnote->id;
            $credit_Note_items->stock_no = 'LS00001';
           
            
            $credit_Note_items->save();

   
    
    flash()->success("New Credit Note Created");
    return redirect()->back();

}
}




