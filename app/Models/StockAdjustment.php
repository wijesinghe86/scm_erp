<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;

    public function createdBy()
    {
        return $this->hasOne(Employee::class,'id','created_by');
    }

    public function approvedBy()
    {
        return $this->hasOne(Employee::class,'id','approved_by');
    }

    public function items()
    {
        return $this->hasMany(StockAdjustmentItem::class,'stock_adjustment_id','id');
    }
}
