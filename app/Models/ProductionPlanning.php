<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionPlanning extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(ProductionPlaningItem::class,'pps_id','id');
    }

}
