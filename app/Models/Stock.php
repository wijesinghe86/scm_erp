<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'warehouse_id','id');
    }
    
    public function item()
    {
        return $this->hasOne(StockItem::class, 'stock_item_id','id');
    }
}
