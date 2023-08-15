<?php

namespace App\Models;

use App\Models\User;
use App\Models\StockItem;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpBalance extends Model
{
    use HasFactory;

    public function createdBy()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function deleteddBy()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function items()
    {
        return $this->belongsTo(StockItem::class,'stock_id','stock_number');
    }
    public function location()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
}
