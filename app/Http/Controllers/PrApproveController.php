<?php

namespace App\Http\Controllers;

use App\Models\MrfPrfItem;
use App\Models\MrfPrfMain;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PrApproveController extends ParentController
{
    public function index()
    {
        //$list = MrfPrfItem::where('prf_id', '>=', '14')->get();
        $list = MrfPrfItem::where('approval_status', '!=', "pending")->latest()->get();
        return view('pages.mrfprf.PrApprove.index', compact('list'));

    }

    public function create()
    {
        $purchase_requests= MrfPrfMain::with(['items'=> function($item){
            return $item->where('approval_status', 'pending');
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'pending');
            })
            ->get();
        return view('pages.mrfprf.PrApprove.create', compact('purchase_requests'));
    }

    public function getItems(Request $request)
    {
        $pr_items = MrfPrfItem::where('prf_id', $request->prf_id)->where('approval_status', 'pending')->get();
        return view('pages.mrfprf.PrApprove.pr_table', compact('pr_items'));

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

            $purchase_request_item = MrfPrfItem::find($item['id']);
            $purchase_request_item->approval_status = $item['approval_status'];
            $purchase_request_item->remark = $item['remark'];
            $purchase_request_item->approval_status_changed_by = request()->user()->id;
            $purchase_request_item->approval_status_changed_at = now();
            if ($item['approval_status'] != null) {
                $purchase_request_item->save();
            }
        }
        flash()->success("Purchase Request approval updated");
        return redirect()->back();
    }
}
