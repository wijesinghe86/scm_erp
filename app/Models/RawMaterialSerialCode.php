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
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_code', 'id');
    }
    public function semi_production_items()
    {
        return $this->belongsTo(SemiProductionItem::class, 'id', 'raw_mat_serial_no');
    }

    public function createUser()
{
    return $this->hasOne(User::class, 'id', 'created_by');
}

}
