<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustmentItem extends Model
{
    use HasFactory;

    public function fromWarehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'from_warehouse');
    }

    public function toWarehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'to_warehouse');
    }

    public function from_stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'from_stock_number');
    }

    public function to_stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'to_stock_number');
    }
}
