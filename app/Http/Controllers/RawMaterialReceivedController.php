<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\RawMaterialIssue;
use Illuminate\Support\Facades\DB;
use App\Models\RawMaterialReceived;
use App\Models\RawMaterialIssueItem;
use App\Models\RawMaterialReceivedItem;
use App\Models\Stock;
use Illuminate\Validation\ValidationException;

class RawMaterialReceivedController extends Controller
{

    public function generateNextNumber()
    {
        $count  = RawMaterialReceived::get()->count();
        return "RMA" . sprintf('%06d', $count + 1);
    }

    public function index()
    {
        $list = RawMaterialReceived::get();
        return view('pages.RawMaterialReceivedForProduction.index', compact('list'));
    }

    public function create()
    {
        $next_number = $this->generateNextNumber();
        $rmi_data = RawMaterialIssue::with(['warehouse', 'createdBy'])->get();
        $employees = Employee::get();
        $warehouses = Warehouse::get();
        return view('pages.RawMaterialReceivedForProduction.create', compact('next_number', 'rmi_data', 'employees', 'warehouses'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $rma = new RawMaterialReceived;
            $rma->rma_no = $request->rma_no;
            $rma->rmi_no = $request->rmi_no;
            $rma->received_location = $request->warehouse_code;
            $rma->received_by = $request->received_by;
            $rma->received_date_time = $request->received_date_time;
            $rma->save();

            $filter_is_selected = collect($request->items)->filter(function ($row) {
                return isset($row['is_selected']);
            });
            if (count($filter_is_selected) == 0) {
                throw ValidationException::withMessages(['items' => "At least one item need to be checked"]);
            }

            foreach ($request->items as $key => $row) {
                if (!isset($row['is_selected'])) {
                    continue;
                }

                $rma_item = new RawMaterialReceivedItem;
                $rma_item->rma_no = $request->rma_no;
                $rma_item->rmi_no = $request->rmi_no;
                $rma_item->stock_item_no = $row['stock_item_no'];
                $rma_item->serial_no = $row['serial_no'];
                $rma_item->received_qty = $row['received_qty'];
                $rma_item->remarks = $row['remarks'];
                $rma_item->save();


                // add Stock
                $stock = Stock::where('stock_item_id', $row['stock_item_no'])
                    ->where('warehouse_id', $request->warehouse_code)
                    ->first();
                $stock->qty = $stock->qty + $row['received_qty'];
                $stock->save();
            }

            DB::commit();
            flash()->success("Raw Material Receive Created");
            return redirect()->route('rawmaterial_received_for_production.index');
        } catch (Exception $e) {
            DB::rollBack();
            logger($e);
        }
    }

    public function getItemList(Request $request)
    {
        $items = RawMaterialIssueItem::with(['semi_product_item.semi_product_stock_item'])->where('rmi_no', $request->rmi_no)->get();
        return view('pages.RawMaterialReceivedForProduction.item_list', compact('items'));
    }
}
