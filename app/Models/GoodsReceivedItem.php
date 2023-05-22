<?php

namespace App\Models;

use App\Models\GoodsReceived;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GoodsReceivedItem extends Model
{
    use HasFactory;
    public function item()
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');
    }
    public function grn()
    {
        return $this->belongsTo(GoodsReceived::class, 'grn_id', 'id');
    }
}
