<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialIssue extends Model
{
    use HasFactory, SoftDeletes;


    public function items()
    {
        return $this->hasMany(RawMaterialIssueItem::class, 'rmi_no', 'rmi_no');
    }

    public function raw_material_request()
    {
        return $this->hasOne(RawMaterialRequest::class, 'id', 'rmr_no');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
