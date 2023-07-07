<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemiProductionItem extends Model
{
    use HasFactory;


    public function semi_production()
    {
        return $this->hasOne(SemiProduction::class, 'id', 'semi_pro_id');
    }

    public function semi_product_stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'semi_pro_stock_no');
    }

    public function raw_material_stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'raw_mat_stock_no');
    }


    public function raw_material_issue_item()
    {
        return $this->hasOne(RawMaterialIssueItem::class, 'semi_product_serial_no', 'semi_pro_serial_no');
    }
}
