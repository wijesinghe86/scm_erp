<?php

namespace App\Models;

use App\Models\DfApproved;
use App\Models\StockItem;
use App\Models\DemandForecasting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class DemandForecastingItems extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');
    }

    public function demandforecastid()
    {
        return $this->belongsTo(DemandForecasting::class, 'df_id', 'id');
    }

    public function approval()
        {
        return $this->hasMany(DfApproved::class,'df_item_id','id');
        }
}
