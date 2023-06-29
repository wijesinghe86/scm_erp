<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialReceived extends Model
{
    use HasFactory, SoftDeletes;

    public function items()
    {
        return $this->hasMany(RawMaterialReceivedItem::class, 'rma_no', 'rma_no');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'received_location');
    }

    public function receivedBy()
    {
        return $this->hasOne(Employee::class, 'id', 'received_by');
    }
}
