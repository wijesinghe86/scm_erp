<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialIssueItem extends Model
{
    use HasFactory, SoftDeletes;

    public function semi_product_item()
    {
        return $this->hasOne(SemiProductionItem::class, 'semi_pro_serial_no', 'semi_product_serial_no');
    }

    public function raw_material_issue()
    {
        return $this->hasOne(RawMaterialIssue::class, 'rmi_no', 'rmi_no');
    }

    public function raw_material_request_item()
    {
        return $this->hasOne(RawMaterialRequestItem::class, 'id', 'issued_item_no');
    }

    public function received()
    {
        return $this->hasOne(RawMaterialReceivedItem::class, 'serial_no', 'semi_product_serial_no');
    }
}
