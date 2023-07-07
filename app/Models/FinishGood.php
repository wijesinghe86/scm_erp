<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishGood extends Model
{
    use HasFactory;


    public function items()
    {
        return $this->hasMany(FinishGoodItem::class, 'fgrn_no', 'fgrn_no');
    }

    public function wastage_items()
    {
        return $this->hasMany(FinishGoodWastage::class, 'fgrn_no', 'fgrn_no');
    }

    public function rmi()
    {
        return $this->hasOne(RawMaterialIssue::class, 'id', 'rmi_no');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function inspectedBy()
    {
        return $this->hasOne(User::class, 'id', 'inspected_by');
    }
}
