<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\FinishGood;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinishedGoodsItemDetails extends Model
{
    use HasFactory;

    public function stock_item_by_stockNumber()
    {
        return $this->hasOne(StockItem::class, 'stock_number', 'pro_stock_no');
    }
    public function finish_good()
    {
        return $this->hasOne(FinishGood::class, 'fgrn_no', 'fgrn_no');
    }

    
}


