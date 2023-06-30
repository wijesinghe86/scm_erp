<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialReceivedItem extends Model
{
    use HasFactory, SoftDeletes;

    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'stock_item_no');
    }
}
