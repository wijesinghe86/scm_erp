<?php

namespace App\Http\Controllers;

use PDF;

use App\Models\Creditnote;
use App\Models\credit_note_item_table;
use Illuminate\Http\Request;


class CreditNotePrintController extends Controller
{
    public function index()
    {
        $creditNotes = Creditnote::with(['items' => function ($item){
        return $item->where('status', '=', 'approved');
    }])->get();
        // logger($creditNotes);
        // ->where('status', '=', 'approved')->get();
        return view('pages.CreditNote.CreditNotePrint.index', compact('creditNotes'));

       
    }

    public function view($creditnote_id)
    {
        $response['creditnotes'] = Creditnote::with(['Items', 'Customer'])->find($creditnote_id);
        $response['credititems'] = credit_note_item_table::where('credit_note_no', $creditnote_id)
        ->where('status','approved')->get();
        if ($response['creditnotes'] == null) {
            return abort(404);
        }
        return view('pages.CreditNote.CreditNotePrint.view')->with($response);
    }

    public function print($creditnote_id)
    {
        $creditnotes = Creditnote::with(['Items', 'Customer'])->find($creditnote_id);
        // $response[''] = InvoiceItem::where('invoice_number', $invoice_id)->get();
        if ($creditnotes == null) {
            return abort(404);
        }

        $pdf = PDF::loadView('pages.CreditNote.CreditNotePrint.print', compact('creditnotes'))->setPaper('A5','landscape');
        return $pdf->stream('credit_note_print.print');
    }

}
