<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandForecasting;
use App\Models\PlantRegistration;
use App\Models\ProductionPlanning;
use App\Models\ProductionPlaningItem;
use App\Models\DemandForecastingItems;
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
        $df_list = DemandForecasting::get();
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
        // dd($request->all());

        $pps = new ProductionPlanning;
        $pps->pps_no = $request->pps_no;
        $pps->pps_date = $request->pps_date;
        $pps->plant = $request->plant;
        $pps->start_date = $request->start_date;
        $pps->end_date = $request->end_date;
        $pps->save();

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
        $lists = DemandForecastingItems::with('item')
            ->where('df_id', $request->df_id)
            ->get();
        return view('pages.ProductionPlanningAndSchedule.df_table', compact('lists'));
    }
}
