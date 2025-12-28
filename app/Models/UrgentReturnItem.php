<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\UrgentReturn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentReturnItem extends Model
{
    use HasFactory;
    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'item_id');
    }
    public function material_return()
    {
        return $this->hasOne(UrgentReturn::class, 'id', 'return_id');
    }
}
