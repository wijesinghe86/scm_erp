<?php

namespace App\Models;

use App\Models\StockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrfPrfItem extends Model
{
    use HasFactory;

    public function item()
{
    return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');

}

}


