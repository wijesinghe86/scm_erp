<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialRequestItem extends Model
{
    use HasFactory, SoftDeletes;

    public function stock_item()
    {
        return $this->hasOne(StockItem::class,'id','raw_material_stock_no');
    }

    public function job_order_item()
    {
        return $this->hasOne(JobOrderItem::class,'id','jo_stock_no');
    }

    public function approval()
    {
        return $this->hasOne(RawMaterialRequestApproval::class,'rmr_item_id','id');
    }

    public function issued()
    {
        return $this->hasOne(RawMaterialIssueItem::class,'issued_item_no','id');
    }
}
