<?php

namespace App\Http\Controllers;

use App\Models\MrPurchase;
use Illuminate\Http\Request;
use App\Models\MrPurchaseItem;

class PurchaseOrderMrApproveController extends ParentController
{
    public function index()
    {
        $list = MrPurchaseItem::where('po_id', '>=', '14')->get();
        // $list = MrfPrfItem::where('approval_status', '!=', "pending")->latest()->get();
        return view('pages.PurchaseOrderMr.PurchaseOrderMrApprove.index', compact('list'));
    }

    public function create()
    {
        $purchase_orders= MrPurchase::with(['items'=> function($item){
            return $item->where('approval_status', 'pending'); 
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'pending');
            })
            ->get();
        return view('pages.PurchaseOrderMr.PurchaseOrderMrApprove.create', compact('purchase_orders'));
    }

    public function getItems(Request $request)
    {
        $po_items = MrPurchaseItem::where('po_id', $request->po_id)->where('approval_status', 'pending')->get();
        return view('pages.PurchaseOrderMr.PurchaseOrderMrApprove.poItems', compact('po_items'));

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

            $purchase_order_item = MrPurchaseItem::find($item['id']);
            $purchase_order_item->approval_status = $item['approval_status'];
            $purchase_order_item->remark = $item['remark'];
            $purchase_order_item->approval_status_changed_by = request()->user()->id;
            $purchase_order_item->approval_status_changed_at = now();
            if ($item['approval_status'] != null) {
                $purchase_order_item->save();
            }
        }
        flash()->success("Purchase Request approval updated");
        return redirect()->back();
    }
}
