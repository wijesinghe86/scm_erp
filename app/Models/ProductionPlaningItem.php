<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionPlaningItem extends Model
{
    use HasFactory;

    public function production_planing()
    {
        return $this->hasOne(ProductionPlanning::class,'id','pps_id');
    }

    public function stock_item()
    {
        return $this->hasOne(StockItem::class,'id','stock_item_id');
    }

    public function demand_forecasting()
    {
        return $this->hasOne(DemandForecasting::class,'id','df_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class,'approval_status_changed_by','id');
    }
}
