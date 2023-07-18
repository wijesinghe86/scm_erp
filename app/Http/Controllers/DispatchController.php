<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Dispatch;
use App\Models\DispatchItem;
use App\Models\Employee;
use App\Models\Warehouse;
use App\Models\FinishGood;
use Illuminate\Http\Request;
use App\Models\FinishGoodItem;
use App\Models\FleetRegistration;
use Illuminate\Support\Facades\DB;

class DispatchController extends Controller
{

    public function generateNextNumber()
    {
        $count  = Dispatch::get()->count();
        return "DIS" . sprintf('%06d', $count + 1);
    }

    public function index()
    {
        $dispatches = Dispatch::get();
        return view('pages.Dispatch.index', compact('dispatches'));
    }

    public function create()
    {
        $employees = Employee::get();
        $fleets = FleetRegistration::get();
        $finished_goods = FinishGood::with(['warehouse', 'items', 'dispatch'])
            ->whereNotNull('inspected_by')
            ->whereDoesntHave('dispatch')
            ->get();
        $next_number = $this->generateNextNumber();
        return view('pages.Dispatch.create', compact('employees', 'fleets', 'finished_goods', 'next_number'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $isExist = Dispatch::where('dispatch_no', $request->dispatch_no)->first();
        if ($isExist) {
            $data['dispatch_no'] = $this->generateNextNumber();
        }

        try {
            DB::beginTransaction();
            $dispatch = new Dispatch;
            $dispatch->date = $request->date;
            $dispatch->dispatch_no = $data['dispatch_no'];
            $dispatch->fgrn_no = $request->fgrn_no;
            $dispatch->tot_no_dispatch_items = $request->tot_no_dispatch_items ? $request->tot_no_dispatch_items : 0;
            $dispatch->tot_no_dispatch_qty = $request->tot_no_dispatch_qty ? $request->tot_no_dispatch_qty : 0;
            $dispatch->tot_no_dispatch_weight = $request->tot_no_dispatch_weight ? $request->tot_no_dispatch_weight : 0;
            $dispatch->fleet_id = $request->fleet_id;
            $dispatch->driver_name = $request->driver_name;
            $dispatch->dispatched_by = $request->dispatched_by;
            $dispatch->dispatched_at = $request->dispatched_at;
            $dispatch->dispatched_remark = $request->dispatched_remark;
            $dispatch->inspected_by = $request->inspected_by;
            $dispatch->inspected_at = $request->inspected_at;
            $dispatch->inspected_remark = $request->inspected_remark;
            $dispatch->save();

            foreach ($request->items as $key => $item) {
                $dispatch_item = new DispatchItem;
                $dispatch_item->fgrn_no = $request->fgrn_no;
                $dispatch_item->fgrn_item_id = $item['fgrn_item_id'];
                $dispatch_item->stock_item_id = $item['stock_item_id'];
                $dispatch_item->dispatch_no = $data['dispatch_no'];
                $dispatch_item->dispatch_qty = $item['dispatch_qty'];
                $dispatch_item->dispatch_weight = $item['dispatch_weight'];
                $dispatch_item->dispatch_from = $request->fgrn_warehouse_id;
                $dispatch_item->dispatch_to = $item['dispatch_to'];
                $dispatch_item->save();
            }

            DB::commit();
            flash()->success("Dispatch Details created successfully!");
            return redirect()->route('dispatch.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e->getMessage());
        }
    }


    public function getFgrnItems(Request $request)
    {
        $items = FinishGoodItem::where('fgrn_no', $request->fgrn_no)->get();
        $warehouses = Warehouse::get();
        return view('pages.Dispatch.item_list', compact('items', 'warehouses'));
    }

    public function getCalculation(Request $request)
    {
        $items = FinishGoodItem::where('fgrn_no', $request->fgrn_no)->get();
        $tot_no_dispatch_items = count($items);
        $tot_no_dispatch_qty = $items->sum('pro_qty');
        $tot_no_dispatch_weight = $items->sum('pro_weight');


        return [
            "tot_no_dispatch_items" => $tot_no_dispatch_items,
            "tot_no_dispatch_qty" => $tot_no_dispatch_qty,
            "tot_no_dispatch_weight" => $tot_no_dispatch_weight,
        ];
    }
}
