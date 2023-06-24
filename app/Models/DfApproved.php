<?php

namespace App\Models;

use App\Models\DemandForecasting;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DfApproved extends Model
{
    use HasFactory;

    public function demand_forecast()
    {
        return $this->belongsTo(DemandForecasting::class, 'df_id', 'id');
    }
    public function item()
    {
        return $this->belongsTo(StockItem ::class, 'item_id', 'id');
    }
    public function approved_by()
    {
        return $this->belongsTo(User::class,'approved_user_id','id');
    }
}
