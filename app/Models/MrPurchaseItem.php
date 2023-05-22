<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockItem;

class MrPurchaseItem extends Model
{
    use HasFactory;

    public function item()
{
    return $this->belongsTo(StockItem::class, 'item_id', 'id');

}
}
