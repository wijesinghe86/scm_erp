<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchItem extends Model
{
    use HasFactory;


    public function finished_good_items()
    {
        return $this->hasOne(FinishGoodItem::class,'id','fgrn_item_id');
    }

    public function stock_item()
    {
        return $this->hasOne(StockItem::class,'id','stock_item_id');
    }

    public function warehouse_from()
    {
        return $this->hasOne(Warehouse::class,'id','dispatch_from');
    }


    public function warehouse_to()
    {
        return $this->hasOne(Warehouse::class,'id','dispatch_to');
    }
}
