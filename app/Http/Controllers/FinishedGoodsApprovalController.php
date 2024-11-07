<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\FinishGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RawMaterialReceived;
use App\Models\FinishedGoodsItemDetails;
use App\Services\StockLogService;

class FinishedGoodsApprovalController extends Controller
{
    public function index()
    {
        $finished_goods_list = FinishGood::get();


        return view('pages.FinishedGoods.FinishedGoodApproval.index', compact('finished_goods_list'));
    }

    public function create(Request $request, FinishGood $finished_good)
    {
        $finished_good->loadMissing('wastage_items.stock_item');
        $finished_good_detail = FinishedGoodsItemDetails::where('fgrn_no',$finished_good->fgrn_no )->get();
        return view('pages.FinishedGoods.FinishedGoodApproval.approval', compact('finished_good','finished_good_detail'));
    }

    public function store(Request $request, FinishGood $finished_good)
    {

        $stockLog = new StockLogService;

//logger($rmr);
//return redirect()->route('finished_goods_approval.index');
        try {
            DB::beginTransaction();
            $finished_good->status = $request->status;
            $finished_good->approval_remark = $request->approval_remark;
            $finished_good->inspected_by = request()->user()->id;
            $finished_good->inspected_at = now();
            $finished_good->save();

            if ($request->status == "approved") {


              // from finished_good_items check warehouse from raw mat rec and deduct stock
              $rmi = $finished_good->rmi;
              $rmr = RawMaterialReceived::where('rmi_no', $rmi->rmi_no)->first();

              $stock_deduct_warehouse = $rmr->received_location;
              foreach ($finished_good->items as $key => $item) {
                $stock_item = $item->stock_item_by_stockNumber;
                $finished_good_item_stock = Stock::where('stock_item_id',$stock_item->id)->where('warehouse_id',$stock_deduct_warehouse )->first();
                if($finished_good_item_stock){
                    $finished_good_item_stock->qty = $finished_good_item_stock->qty - $item->rmi_qty;
                    $finished_good_item_stock->save();
                }
              }


            // from finished_good_details check warehouse from finished_good table and add the total amount
            $finished_good_items_detail = FinishedGoodsItemDetails::where('fgrn_no', $finished_good->fgrn_no )->get();
            foreach ($finished_good_items_detail as $key => $finished_good_items_detail_item) {
                $vfinished_good_items_detail_stock_item =$finished_good_items_detail_item->stock_item_by_stockNumber;
                $finished_good_detail_stock = Stock::where('stock_item_id',$vfinished_good_items_detail_stock_item->id)->where('warehouse_id',$finished_good->warehouse_id )->first();
                if($finished_good_detail_stock){
                    $finished_good_detail_stock->qty = $finished_good_detail_stock->qty + $finished_good_items_detail_item->pro_qty;
                    $finished_good_detail_stock->save();


                    $stockLog->createLog(
                        StockLogService::$FINISHED_GOODS,
                        $finished_good->warehouse_id,
                        $vfinished_good_items_detail_stock_item->id,
                        $finished_good_items_detail_item->pro_qty,
                        StockLogService::$ADD,
                        $finished_good->fgrn_no,
                        $request->user()->id,
                        null,
                    );

            }

            }

                foreach ($finished_good->wastage_items as $key => $wastage_item) {
                    $wastage_item_stock = Stock::where('stock_item_id', $wastage_item->stock_item_id)
                    ->where('warehouse_id', $finished_good->warehouse_id)->first();
                    $wastage_item_stock->qty = $wastage_item_stock->qty + $wastage_item->qty;
                    $wastage_item_stock->save();

                    $stockLog->createLog(
                        StockLogService::$GFRN_WASTAGE,
                        $finished_good->warehouse_id,
                        $wastage_item->stock_item_id,
                        $wastage_item->qty,
                        StockLogService::$ADD,
                        $finished_good->fgrn_no,
                        $request->user()->id,
                        null,
                    );

                }
            }
            DB::commit();
            flash()->success("Good Received Inspection Done");
            return redirect()->route('finished_goods_approval.index');
        } catch (Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            logger($e->getMessage());
        }
    }
}
