<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\FinishGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinishedGoodsApprovalController extends Controller
{
    public function index()
    {
        $finished_goods_list = FinishGood::get();
        return view('pages.FinishedGoods.FinishedGoodApproval.index', compact('finished_goods_list'));
    }

    public function create(Request $request, FinishGood $finished_good)
    {
        $finished_good->loadMissing('items.stock_item');
        $finished_good->loadMissing('wastage_items.stock_item');
        return view('pages.FinishedGoods.FinishedGoodApproval.approval', compact('finished_good'));
    }

    public function store(Request $request, FinishGood $finished_good)
    {
        try {
            DB::beginTransaction();
            $finished_good->status = $request->status;
            $finished_good->approval_remark = $request->approval_remark;
            $finished_good->inspected_by = request()->user()->id;
            $finished_good->inspected_at = now();
            $finished_good->save();

            if ($request->status == "approved") {
                //stock handle
                //reduce rma stock from rma warehouse
                $rma_warehouse = $finished_good->rmi->warehouse_id;
                foreach ($finished_good->items->groupBy('semi_product_serial_no') as $semi_product_serial_no => $items) {
                    $rma_item_qty =  $items->unique('semi_product_serial_no')->sum('rmi_qty');
                    $stock_item = StockItem::where('stock_number', $items[0]['rmi_item_stock_number'])->first();
                    $stock = Stock::where('stock_item_id', $stock_item->id)->where('warehouse_id', $rma_warehouse)->first();
                    $stock->qty = $stock->qty - $rma_item_qty;
                    // $stock->save();
                }

                //add finished goods stock
                foreach ($finished_good->items as $key => $item) {
                    $finished_good_stock = Stock::where('stock_item_id', $item->stock_item_id)->where('warehouse_id', $item->warehouse_id)->first();
                    $finished_good_stock->qty = $finished_good_stock->qty + $item->pro_qty;
                    $finished_good_stock->save();
                }

                foreach ($finished_good->wastage_items as $key => $wastage_item) {
                    $wastage_item_stock = Stock::where('stock_item_id', $wastage_item->stock_item_id)->where('warehouse_id', $finished_good->warehouse_id)->first();
                    $wastage_item_stock->qty = $wastage_item_stock->qty + $wastage_item->qty;
                    $wastage_item_stock->save();
                }
            }
            DB::commit();
            flash()->success("Good Issue Inspection Done");
            return redirect()->route('finished_goods_approval.index');
        } catch (Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            logger($e->getMessage());
        }
    }
}
