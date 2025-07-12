<?php

namespace App\Models;

use App\Models\User;
use App\Models\StockItem;
use App\Models\Warehouse;
use App\Models\DeliveryOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DamageReturn extends Model
{
    use HasFactory;

    public function createdBy()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function delivery_no()
    {
        return $this->hasOne(DeliveryOrder::class, 'id', 'reference_id');
    }

    public function ori_items()
    {
        return $this->belongsTo(StockItem::class,'ori_stock_id','stock_number');
    }
    public function dmg_items()
    {
        return $this->belongsTo(StockItem::class,'dmg_stock_id','stock_number');
    }
    public function location()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
}
