<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLocationChangeItem extends Model
{
    use HasFactory;


    public function stock_item()
    {
        return $this->hasOne(StockItem::class,'id','stock_item_id');
    }
}
