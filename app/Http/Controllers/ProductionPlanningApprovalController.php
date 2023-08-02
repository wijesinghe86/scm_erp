<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionPlanning;
use App\Models\ProductionPlaningItem;
use Illuminate\Validation\ValidationException;

class ProductionPlanningApprovalController extends Controller
{
    public function index()
    {
        $list = ProductionPlaningItem::where('approval_status', '!=', "pending")->latest()->get();
        return view('pages.ProductionPlanningAndScheduleApproval.index', compact('list'));
    }

    public function create()
    {
        $production_plannings = ProductionPlanning::with(['items' => function ($item) {
            return $item->where('approval_status', 'pending');
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'pending');
            })
            ->get();
        return view('pages.ProductionPlanningAndScheduleApproval.create', compact('production_plannings'));
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

            $production_planing_item = ProductionPlaningItem::find($item['id']);
            $production_planing_item->approval_status = $item['approval_status'];
            $production_planing_item->remark = $item['remark'];
            $production_planing_item->approval_status_changed_by = request()->user()->id;
            $production_planing_item->approval_status_changed_at = now();
            if ($item['approval_status'] != null) {
                $production_planing_item->save();
            }
        }
        flash()->success("Product planing and schedule approval updated");
        return redirect()->back();
    }

    public function getItems(Request $request)
    {
        $pps_items = ProductionPlaningItem::where('pps_id', $request->pps_id)->where('approval_status', 'pending')->get();
        return view('pages.ProductionPlanningAndScheduleApproval.create_list_table', compact('pps_items'));
    }
}
