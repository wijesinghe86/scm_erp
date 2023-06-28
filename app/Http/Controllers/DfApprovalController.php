<?php

namespace App\Http\Controllers;

use App\Models\DfApproved;
use Illuminate\Http\Request;
use App\Models\DemandForecasting;
use App\Models\DemandForecastingItems;
use Illuminate\Validation\ValidationException;


class DfApprovalController extends Controller
{
    public function index()
    {
        $list = DfApproved::where('action', '!=', "pending")->latest()->get();
        return view('pages.DemandForecasting.DFApprove.index', compact('list'));
    }

    public function create()
    {
        $df_list = DemandForecasting::with(['approvals'])
            ->whereDoesntHave('approvals')
            ->get();
        return view('pages.DemandForecasting.DFApprove.create', compact('df_list'));
    }

    public function getDfApprovedItems(Request $request)
    {
        $list = DemandForecastingItems::with('approval_items')->where('df_id', $request->df_id)->get();
        return view('pages.DemandForecasting.DFApprove.dfItem', compact('list'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'items' => 'required|array',
            'items.*.approved_qty' => 'required_if:items.*.is_selected,on',
            'items.*.action' => 'required_if:items.*.is_selected,on',
        ]);

        $filter_is_selected = collect($request->items)->filter(function ($row) {
            return isset($row['is_selected']);
        });
        if (count($filter_is_selected) == 0) {
            throw ValidationException::withMessages(['items' => "The items list cannot be empty"]);
        }

        foreach ($request->items as $key => $item) {
            if (!isset($item['is_selected'])) {
                continue;
            }

            $df_approval = new DfApproved;
            $df_approval->df_item_id = $item['id'];
            $df_approval->item_id = $item['item_id'];
            $df_approval->df_id = $request->df_no;
            $df_approval->approved_qty = $item['approved_qty'];
            $df_approval->remark = $item['remarks'];
            $df_approval->action = $item['action'];
            $df_approval->df_created_user_id = $request->requested_by_id;
            $df_approval->approved_user_id = request()->user()->id;
            $df_approval->save();
        }
        flash()->success("Demand forecast approval updated");
        return redirect()->back();
    }

    public function getDfData(Request $request)
    {
        $demand_forecasting = DemandForecasting::with('createUser')->find($request->df_id);
        return $demand_forecasting;
    }
}
