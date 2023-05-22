<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\FleetRegistration;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockLocationChangeIssued;
use App\Models\StockLocationChangeReceived;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class StockLocationChange extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'ref_number',
        'slc_date',
        'slc_number',
        'delivered_by',
        'status',
        'delivered_date',
        'fleet_id',
        'remarks',
        'created_by'
    ];

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function Employee()
    {
        return $this->hasOne(Employee::class, 'id', 'delivered_by');
    }

    public function Fleet()
    {
        return $this->hasOne(FleetRegistration::class, 'id', 'fleet_id');
    }

    public function slc_issued_items()
    {
        return $this->hasMany(StockLocationChangeIssued::class,'slc_id','id');
    }

    public function slc_received_items()
    {
        return $this->hasMany(StockLocationChangeReceived::class,'slc_id','id');
    }
}

