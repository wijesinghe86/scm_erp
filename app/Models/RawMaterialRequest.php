<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialRequest extends Model
{
    use HasFactory, SoftDeletes;

    public function job_order()
    {
        return $this->hasOne(JobOrder::class, 'id', 'job_order_no');
    }

    public function plant()
    {
        return $this->hasOne(PlantRegistration::class, 'plant_number', 'plant_id');
    }

    public function items()
    {
        return $this->hasMany(RawMaterialRequestItem::class, 'rmr_no', 'id');
    }

    public function requestedBy()
    {
        return $this->hasOne(Employee::class,'id','requested_by');
    }
}
