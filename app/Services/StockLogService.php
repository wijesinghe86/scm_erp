<?php

namespace App\Services;


class StockLogService
{
    public function createLog($event = null,$qty_from = 0, $qty_to = 0,$request,$stock_item ){
        $stock_log = new StockLog;
                $stock_log->event = $event;
                $stock_log->request = $request;
                $stock_log->stock_item = $stock_item;
                $stock_log->qty_from = $qty_from;
                $stock_log->qty_to = $qty_to;
    }

    
}
