<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingRequestItem extends Model
{
    use HasFactory;

    public function item(){
        return $this->belongsTo(StockItem::class,'stock_item_id','id');//->withTrashed();
    }
}
