<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use HasFactory, SoftDeletes;


    public function plant()
    {
        return $this->hasOne(PlantRegistration::class,'id','plant_id');
    }

    public function items()
    {
        return $this->hasMany(JobOrderItem::class,'job_order_id','id');
    }
}
