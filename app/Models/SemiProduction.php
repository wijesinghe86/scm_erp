<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemiProduction extends Model
{
    use HasFactory;

    public function created_user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function semi_product_items()
    {
        return $this->hasMany(SemiProductionItem::class,'semi_pro_id','id');
    }

    public function raw_material_stock_item()
    {
        return $this->hasOne(StockItem::class,'id','raw_material_stock_no');
    }

    public function raw_material_serial_item()
    {
        return $this->hasOne(RawMaterialSerialCode::class,'id','raw_material_serial_no');
    }

    public function plant()
    {
        return $this->hasOne(PlantRegistration::class,'id','plant_id');
    }


    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

}
