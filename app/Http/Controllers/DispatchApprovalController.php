<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\DispatchItem;
use App\Models\Stock;
use Illuminate\Http\Request;

class DispatchApprovalController extends Controller
{
    public function index()
    {
        $dispatch_list = Dispatch::with(['items' => function ($item) {
            return $item->whereNull('approve_by');
        }])
            ->whereHas('items')
            ->get();
        return view('pages.Dispatch.Approval.index', compact('dispatch_list'));
    }

    public function create(Request $request, Dispatch $dispatch_item)
    {
        return view('pages.Dispatch.Approval.create', compact('dispatch_item'));
    }

    public function store(Request $request)
    {
        foreach ($request->items as $key => $item) {
            $dispatch_item = DispatchItem::find($item['id']);
            $dispatch_item->approve_status = $item['status'];
            $dispatch_item->approve_by = request()->user()->id;
            $dispatch_item->approve_at = now();
            $dispatch_item->save();

            if ($item['status'] == "approved") {
                $stock_from = Stock::where('stock_item_id', $dispatch_item->stock_item_id)->where('warehouse_id', $dispatch_item->dispatch_from)->first();
                $stock_from->qty = $stock_from->qty - $dispatch_item->dispatch_qty;
                $stock_from->save();

                $stock_to = Stock::where('stock_item_id', $dispatch_item->stock_item_id)->where('warehouse_id', $dispatch_item->dispatch_to)->first();
                $stock_to->qty = $stock_to->qty + $dispatch_item->dispatch_qty;
                $stock_to->save();
            }
        }

        flash()->success("Dispatch Status updated");
        return redirect()->route('dispatch_approval.index');
    }
}
