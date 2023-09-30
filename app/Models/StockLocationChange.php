<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLocationChange extends Model
{
    use HasFactory;


    public function items()
    {
        return $this->hasMany(StockLocationChangeItem::class, "slc_id", "id");
    }

    public function from_warehouse()
    {
        return $this->hasOne(Warehouse::class, "id", "from_location");
    }

    public function to_warehouse()
    {
        return $this->hasOne(Warehouse::class, "id", "to_location");
    }


    public function issuedBy()
    {
        return $this->hasOne(Employee::class, "id", "issued_by");
    }


    public function receivedBy()
    {
        return $this->hasOne(Employee::class, "id", "received_by");
    }

    public function deliveredBy()
    {
        return $this->hasOne(Employee::class, "id", "delivered_by");
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, "id", "created_by");
    }
    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }


    public function fleet()
    {
        return $this->hasOne(FleetRegistration::class, "id", "fleet_id");
    }
}
