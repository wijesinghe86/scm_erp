<?php

namespace App\Models;

use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentDeliveryItem extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(StockItem::class, 'item_id', 'stock_number');
    
    }
}
