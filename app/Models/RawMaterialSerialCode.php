<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialSerialCode extends Model
{
    use HasFactory;

    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function item()
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');
    }

    public function grn()
    {
        return $this->belongsTo(GoodsReceived::class, 'grn_id', 'id');
    }

}
