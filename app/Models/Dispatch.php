<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(DispatchItem::class, 'dispatch_no', 'dispatch_no');
    }

    public function finished_good()
    {
        return $this->hasOne(FinishGood::class, 'id', 'fgrn_no');
    }

    public function fleet()
    {
        return $this->hasOne(FleetRegistration::class, 'id', 'fleet_id');
    }

    public function dispatchedBy()
    {
        return $this->hasOne(Employee::class, 'id', 'dispatched_by');
    }


    public function inspectedBy()
    {
        return $this->hasOne(Employee::class, 'id', 'inspected_by');
    }
}
