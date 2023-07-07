<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MrApproved;
use Illuminate\Http\Request;
use App\Models\MaterialRequest;
use App\Models\DemandForecasting;
use App\Models\MaterialRequestItem;
use App\Models\DemandForecastingItems;

class DfController extends ParentController
{
    public function index()
    {
        $demandforecastings = DemandForecasting::get();
        return view('pages.DemandForecasting.all', compact('demandforecastings'));
    }

    public function create()
    {

        $employees = Employee::with(['departmentData', 'sectionData'])->get();
        $mr_list = MaterialRequest::with(['mr_approved', 'df_items'])
            ->whereHas('request_items.approval_production')
            ->doesntHave('df_items')
            ->get();

        $last_df = DemandForecasting::latest()->first();
        $last_df_number = 0;
        if ($last_df != null) {
            $last_df_number = $last_df->id;
        }
        $next_number = "DF" . sprintf("%04d", $last_df_number + 1);
        return view('pages.DemandForecasting.new', compact('mr_list', 'employees', 'next_number'));
    }

    public function getMrfItems(Request $request)
    {
        $lists =  MaterialRequestItem::with(['item', 'approval_production'])
            ->where('mr_id', $request->mr_id)
            ->approvedForProduction()
            ->get();
        return view('pages.DemandForecasting.mrf_table', compact('lists'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'requested_by'=> 'required',
        ]);


        $df = new DemandForecasting;
        $df->df_no = $request->df_no;
        $df->df_date = $request->df_date;
        $df->requested_by = $request->requested_by;
        $df->required_date = $request->required_date;
        $df->created_by = request()->user()->id;
        $df->updated_by = request()->user()->id;
        $df->save();

        foreach ($request->items as $row) {
            if (!isset($row['is_selected'])) {
                continue;
            }

            $df_item = new DemandForecastingItems();
            $df_item->stock_item_id = $row['item_id'];
            $df_item->qty = $row['qty'];
            $df_item->mr_id = $request->mrf_no;
            $df_item->df_id = $df->id;
            $df_item->save();

            $pending_qty = $df_item->qty; // 3
            $approved_items =  MrApproved::where('mr_id', $df_item->mr_id)
                ->where('item_id', $df_item->stock_item_id)
                ->where('status', 'approved')
                ->where('approved_for', 'production')
                ->where('remaining_qty', '>', 0)
                ->get();

            foreach ($approved_items as $approved_item) {

                if ($pending_qty == 0) {
                    return;
                }
                // 2 > 3
                if ($approved_item->remaining_qty  > $pending_qty) {
                    $deduct_qty =  $pending_qty;
                    $approved_item->remaining_qty = $approved_item->remaining_qty - $deduct_qty;
                    $approved_item->save();
                    $pending_qty = $pending_qty - $deduct_qty;
                } else {
                    $deduct_qty =  $approved_item->remaining_qty;
                    $approved_item->remaining_qty  = 0;
                    $approved_item->save();
                    $pending_qty = $pending_qty - $deduct_qty;
                }
            }
        }

        flash()->success("Demand forecasting created");
        return redirect()->back();
    }
}
