<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishGoodItem extends Model
{
    use HasFactory;

    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'stock_item_id');
    }
    public function stock_item_by_stockNumber()
    {
        return $this->hasOne(StockItem::class, 'stock_number', 'rmi_item_stock_number');
    }
}
