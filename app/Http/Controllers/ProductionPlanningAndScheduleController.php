<?php

namespace App\Http\Controllers;

use App\Models\DfApproved;
use Illuminate\Http\Request;
use App\Models\DemandForecasting;
use App\Models\PlantRegistration;
use App\Models\ProductionPlanning;
use App\Models\ProductionPlaningItem;
use App\Models\DemandForecastingItems;
use Illuminate\Validation\ValidationException;

// use App\Models\ProductionPlanningItem;


class ProductionPlanningAndScheduleController extends Controller
{
    public function index()
    {
        $productionplanningandschedules = ProductionPlanning::get();
        return view('pages.ProductionPlanningAndSchedule.index', compact('productionplanningandschedules'));
    }

    public function create()
    {
        $df_list = DemandForecasting::with(['approvals' => function ($item) {
            return $item->where('action', 'approved');
        }, 'production_planing'])
            ->whereHas('approvals', function ($q) {
                return $q->where('action', 'approved');
            })
            ->whereDoesntHave('production_planing')
            ->get();
        $plants = PlantRegistration::get();

        $last_pps = ProductionPlanning::latest()->first();
        $last_pps_number = 0;
        if ($last_pps != null) {
            $last_pps_number = $last_pps->id;
        }
        $next_number = "PPS" . sprintf("%04d", $last_pps_number + 1);
        return view('pages.ProductionPlanningAndSchedule.create', compact('df_list', 'next_number', 'plants'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'pps_date'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        // logger(request(all));

        $pps = new ProductionPlanning;
        $pps->pps_no = $request->pps_no;
        $pps->pps_date = $request->pps_date;
        $pps->plant = $request->plant;
        $pps->start_date = $request->start_date;
        $pps->end_date = $request->end_date;
        $pps->df_id = $request->df_id;
        $pps->save();

        $filter_is_selected = collect($request->items)->filter(function ($row) {
            return isset($row['is_selected']);
        });
        if (count($filter_is_selected) == 0) {
            throw ValidationException::withMessages(['items' => "The items list cannot be empty"]);
        }

        foreach ($request->items as $row) {
            if (!isset($row['is_selected'])) {
                continue;
            }

            $pps_item = new ProductionPlaningItem();
            $pps_item->stock_item_id = $row['item_id'];
            $pps_item->pps_qty = $row['pps_qty'];
            $pps_item->weight = $row['weight'];
            $pps_item->df_id = $request->df_id;
            $pps_item->pps_id = $pps->id;
            $pps_item->created_by = request()->user()->id;
            $pps_item->updated_by = request()->user()->id;
            $pps_item->save();
        }
        flash()->success("New Production Planning created");
        return redirect()->back();
    }

    public function getDfItems(request $request)
    {
        $lists = DfApproved::where('df_id', $request->df_id)
            ->where('action', 'approved')
            ->get();
        return view('pages.ProductionPlanningAndSchedule.df_table', compact('lists'));
    }
}
