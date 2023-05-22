<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FleetRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['fleet_number',
    'fleet_name',
    'fleet_registration_number',
    'fleet_model_manufacture',
    'category_of_fleet',
    'current_meter_reading',
    'type_of_fuel_consumption',
    'loading_capacity',
    'fleet_type',
    'make',
    'model',
    'fleet_manufacture_year',
    'colour',
    'engine_capacity',
    'engine_number',
    'chassis_number',
    'tax_period_from',
    'tax_period_to',
    'paid_amount',
    'insured_company',
    'insurance_policy',
    // 'period',
    'insurance_start_date',
    'insurance_expire_date',
    'amount',
    'created_by',
    'updated_by',
    'deleted_by'];

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function UpdateUser()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function deleteUser()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
