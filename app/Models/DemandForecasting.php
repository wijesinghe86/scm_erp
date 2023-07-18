<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandForecasting extends Model
{
    use HasFactory;
    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function items()
    {
        return $this->hasMany(DemandForecastingItems::class,'df_id','id');
    }

    public function approvals()
    {
        return $this->hasMany(DfApproved::class,'df_id','id');
    }

    public function production_planing()
    {
        return $this->hasMany(ProductionPlanning::class,'df_id','id');
    }
}
