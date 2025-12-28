<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UrgentInvoice;
use App\Models\UrgentReturn;
use App\Models\UrgentReturnItem;
use Illuminate\Http\Request;

class ReverseCreditNoteController extends Controller
{
    public function index()
    {
        return view('pages.ReverseCreditNote.index');
    }

    // public function generateNextNumber()
    // {   $count  = Creditnote::get()->count();
    //     return "JTF-CN" . sprintf('%06d', $count + 1);
    // }

    public function create(Request $request)
    {   $urgent_invoices = UrgentInvoice::with(['customer'])
        ->get();
        $rmrs = []; //not loading mrs no without selecting invoice
        //$creditNote = new Creditnote();
        //$next_number = $this->generateNextNumber();
        return view ('pages.ReverseCreditNote.create', compact('urgent_invoices', 'rmrs'));
    }
    public function getInvDetails(Request $request){
        $rmrs = UrgentReturn::where('invoice_id', $request->invoice_id)->get();
        
        return[
            
            'rmrs'=>$rmrs,
            
        ];
    }
    public function getReturn(Request $request)
    {
        $rmrs_list = UrgentReturnItem::with(['stock_item', 'material_return.get_invoice'])
                    ->where('return_id', $request->return_id)
                    ->get(); 
                        
        return view('pages.CreditNote.returnitems', compact('rmrs_list'));
    }


}
