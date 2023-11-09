<?php

namespace App\Models;


use App\Models\Employee;
use App\Models\MrfPrfItem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialRequest extends Model
{
    use HasFactory;

    public function createUser()
{
    return $this->hasOne(User::class, 'id', 'created_by_id');
}

public function request_items()
    {
        return $this->hasMany(MaterialRequestItem::class,'mr_id','id');
    }

    public function mr_approved()
    {
        return $this->hasMany(MrApproved::class,'mr_id','id');
    }
    public function df_items(){
        return $this->hasMany(DemandForecastingItems::class,'mr_id','id');
    }

    public function prf_items(){
    return $this->hasMany(MrfPrfItem::class,'mr_id','id');
     }


    public function requested_by()
    {
         return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    
}


