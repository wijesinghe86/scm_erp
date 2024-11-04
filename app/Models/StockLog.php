<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockLog extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(StockItem::class,'stock_id','id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'location', 'id');;
    }
}
