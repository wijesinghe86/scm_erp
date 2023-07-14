<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\JobOrderItem;
use Illuminate\Http\Request;

class JobOrderApprovalController extends Controller
{
    public function index()
    {
        $list = JobOrderItem::where('approval_status','!=', "pending")->latest()->get();
        return view('pages.JobOrderApproval.index', compact('list'));
    }

    public function create()
    {
        $job_orders = JobOrder::with(['items' => function ($item) {
            return $item->where('approval_status', 'pending');
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'pending');
            })
            ->get();
        return view('pages.JobOrderApproval.create', compact('job_orders'));
    }

    public function store(Request $request)
    {
        foreach ($request->items as $key => $item) {
            if (!isset($item['is_selected'])) {
                continue;
            }

            $job_order_item = JobOrderItem::find($item['id']);
            $job_order_item->approval_status = $item['approval_status'];
            $job_order_item->approval_remark = $item['approval_remark'];
            $job_order_item->approval_status_changed_by = request()->user()->id;
            $job_order_item->approval_status_changed_at = now();
            if ($item['approval_status'] != null) {
                $job_order_item->save();
            }
        }
        flash()->success("Job Order approval updated");
        return redirect()->back();
    }

    public function getItems(Request $request)
    {
        $job_order_items = JobOrderItem::where('job_order_id', $request->job_order_id)->where('approval_status', 'pending')->get();
        return view('pages.JobOrderApproval.create_list_table', compact('job_order_items'));
    }
}
