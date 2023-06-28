<?php

namespace App\Http\Controllers;

use App\Models\RawMaterialRequest;
use App\Models\RawMaterialRequestApproval;
use App\Models\RawMaterialRequestItem;
use Illuminate\Http\Request;

class RawMaterialRequestApproveController extends Controller
{
    public function index()
    {
        $rmr_approvals = RawMaterialRequestApproval::get();
        return view('pages.RawMaterialRequest.RawMaterialRequestApprove.index',compact('rmr_approvals'));
    }

    public function create()
    {
        $rmr_list = RawMaterialRequest::with('items.job_order_item', 'requestedBy')->get();
        return view('pages.RawMaterialRequest.RawMaterialRequestApprove.create', compact('rmr_list'));
    }

    public function store(Request $request)
    {
        foreach ($request->items as $key => $item) {
            $rmr_approval = new RawMaterialRequestApproval;
            $rmr_approval->rmr_no = $request->rmr_id;
            $rmr_approval->rmr_item_id = $item['rmr_item_id'];
            $rmr_approval->jo_order_id = $item['jo_order_id'];
            $rmr_approval->jo_order_item_id = $item['jo_order_item_id'];
            $rmr_approval->approved_qty = $item['approved_qty'];
            $rmr_approval->approved_weight = $item['approved_weight'];
            $rmr_approval->justification = $item['justification'];
            $rmr_approval->approved_at = now();
            $rmr_approval->approved_by = request()->user()->id;
            $rmr_approval->save();
        }
        flash()->success('Raw Material Request Approval Updated Successfully');
        return redirect()->route('raw_material_request_approve.index');
    }

    public function viewCartTable(Request $request)
    {
        $items = RawMaterialRequestItem::where('rmr_no', $request->rmr_no)->get();
        return view('pages.RawMaterialRequest.RawMaterialRequestApprove.approval_items', compact('items'));
    }
}
