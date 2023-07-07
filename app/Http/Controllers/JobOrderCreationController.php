<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobOrder;
use App\Models\JobOrderItem;
use Doctrine\DBAL\Exception;
use Illuminate\Http\Request;
use App\Models\PlantRegistration;
use App\Models\ProductionPlanning;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionPlaningItem;
use Illuminate\Validation\ValidationException;


class JobOrderCreationController extends Controller
{

    public function generateJobOrderNumber()
    {
        $first_letter = "JOB";
        $job_order_count = JobOrder::count();
        return $first_letter . sprintf('%06d', $job_order_count + 1);
    }

    public function index()
    {
        $job_order_items = JobOrderItem::get();
        return view('pages.JobOrderCreation.index',compact('job_order_items'));
    }

    public function create()
    {
        $next_job_order_number = $this->generateJobOrderNumber();
        $production_plannings = ProductionPlanning::with(['demand_forecasting', 'items' => function ($item) {
            return $item->where('approval_status', 'approved');
        }])
            ->whereHas('items', function ($q) {
                return $q->where('approval_status', 'approved');
            })
            ->get();

        $plants = PlantRegistration::get();
        $employees = Employee::get();
        return view('pages.JobOrderCreation.create', compact('production_plannings', 'plants', 'employees', 'next_job_order_number'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'job_order_no'=>'required',
            'jo_date'=>'required',
            'pps_no'=>'required',
            'df_no'=>'required',
            'plant_id'=>'required',
            'start_date_time'=>'required',
            'end_date_time'=>'required',
            'supervisor'=>'required',
            'items'=>'required|array',
            'items.*.jo_qty'=>'required_if:items.*.is_selected,on',
        ]);

        if (count($request->items) == 0) {
            throw ValidationException::withMessages(['items' => 'please add raw material item']);
        }

        try {
            DB::beginTransaction();

            $data = $request->all();

            $isJobOrderNumberTaken = JobOrder::where('job_order_no', $request->job_order_no)->first();
            if ($isJobOrderNumberTaken) {
                $data['job_order_no'] = $this->generateJobOrderNumber();
            }

            $job_order = new JobOrder;
            $job_order->job_order_no = $data['job_order_no'];
            $job_order->jo_date =  $request->jo_date;
            $job_order->pps_no = $request->pps_no;
            $job_order->df_no = $request->df_no;
            $job_order->plant_id = $request->plant_id;
            $job_order->supervisor = $request->supervisor;
            $job_order->start_date_time = $request->start_date_time;
            $job_order->end_date_time = $request->end_date_time;
            $job_order->created_by = request()->user()->id;
            $job_order->save();


            foreach ($request->items as $key => $item) {
                if (!isset($item['is_selected'])) {
                    continue;
                }
                $job_order_item = new JobOrderItem;
                $job_order_item->job_order_id =  $job_order->id;
                $job_order_item->stock_id =  $item['item_id'];
                $job_order_item->jo_qty = $item['jo_qty'];
                $job_order_item->pps_no =  $request->pps_no;
                $job_order_item->created_by =  request()->user()->id;
                $job_order_item->save();
            }

            DB::commit();
            flash()->success("Job Order Created");
            return redirect()->route('jobordercreation.index');
        } catch (Exception $error) {
            logger($error);
            DB::rollBack();
        }
    }


    public function getItems(Request $request)
    {
        $pps_items = ProductionPlaningItem::where('pps_id', $request->pps_id)->where('approval_status', 'approved')->get();
        return view('pages.JobOrderCreation.create_list_table', compact('pps_items'));
    }
}
