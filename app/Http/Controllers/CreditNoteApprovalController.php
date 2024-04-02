<?php

namespace App\Http\Controllers;

use App\Models\Creditnote;
use App\Models\credit_note_item_table;
use Illuminate\Http\Request;

class CreditNoteApprovalController extends Controller
{
    public function index()
    {
        $creditNotes = Creditnote::with(['items', 'invoice'])->get();
        return view('pages.CreditNote.CreditNoteApproval.index', compact('creditNotes'));
    }

    public function create(Request $request)
    {
        $list = Creditnote::with(['invoice','invoice.Customer'])->get();
       logger($list);
        return view('pages.CreditNote.CreditNoteApproval.create', compact('list'));
    }

    public function getCnDetails()
    {
        $creditNotes = Creditnote::get();
    }

    public function getCnItems(Request $request)
    {
        $item_list = credit_note_item_table::with('stockItems')
                     ->where('credit_note_no', $request->credit_note_no)->get();
                     return view('pages.CreditNote.CreditNoteApproval.cnitems', compact('item_list'));
    }

    public function store(Request $request)
    {
        $filter_is_selected = collect($request->items)->filter(function ($row) {
            return isset($row['is_selected']);
        });
        if (count($filter_is_selected) == 0) {
            throw ValidationException::withMessages(['items' => "At least select one item to approve"]);
        }
        foreach ($request->items as $key => $item) {
            if (!isset($item['is_selected'])) {
                continue;
            }

            $credit_item = credit_note_item_table::find($item['id']);
            $credit_item->status = $item['approval_status'];
            $credit_item->status_updated_by = request()->user()->id;
            $credit_item->status_updated_date_time = now();
            if ($item['approval_status'] != null) {
                $credit_item->save();
            }
        }
        flash()->success("Credit Note approval updated");
        return redirect()->back();
    }
}
