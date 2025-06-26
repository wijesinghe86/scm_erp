<?php

namespace App\Services;

use App\Models\StockLog;


class StockLogService
{

    public static $STOCK_ADJUSTMENT_SHORT = "stock_adjustment_short";
    public static $STOCK_ADJUSTMENT_TRANSFER = "stock_adjustment_transfer";
    public static $STOCK_ADJUSTMENT_EXCESS = "stock_adjustment_excess";
    public static $STOCK_LOCATION_ISSUED = "stock_location_issued";
    public static $STOCK_LOCATION_RECEIVED = "stock_location_received";
    public static $DELIVERY_ORDER = "delivery_order";
    public static $GOODS_RECCEIVED = "goods_received";
    public static $MATERIAL_RETURN = "material_return";
    public static $OPENNING_BALANCE = "openning_balance";
    public static $RAWMATERIAL_ISSUE = "raw_material_issue";
    public static $RAWMATERIAL_RECEIVE = "raw_material_receive";
    public static $SLITTING = "slitting";
    public static $SEMI_PRODUCTION = "semi_production";
    public static $FINISHED_GOODS = "finished_goods";
    public static $GFRN_WASTAGE = "fgrn_wastage";
    public static $INTERNAL_ISSUE = "internal_issue";
    public static $ADD = "add";
    public static $DEDUCT = "deduct";
    public static $URGENT_DELIVERY = "urgent_delivery";
    public static $DAMAGE_RETURN = "damage_return";

    public function createLog(
        $event,
        $location = null,
        $stock_id = null,
        $qty = 0,
        $transaction_type = null,
        $reference = null,
        $created_by = null,
        $edited_by = null,
    ) {
        // logger($event);
        // logger($from_location);
        // logger($to_location);
        // logger($stock_no);
        // logger($qty);
        // logger($transaction_type);
        // logger($reference);
        // logger($created_by);
        // logger($edited_by);
        $stock_log = new StockLog();
        $stock_log->event = $event;
        $stock_log->location = $location;
        $stock_log->stock_id = $stock_id;
        $stock_log->qty = $qty;
        $stock_log->transaction_type = $transaction_type;
        $stock_log->transaction_date = now();
        $stock_log->reference = $reference;
        $stock_log->created_by = $created_by ?? null;
        $stock_log->edited_by = $edited_by ?? null;
            $stock_log->save();
         logger($stock_log);
    }
}
