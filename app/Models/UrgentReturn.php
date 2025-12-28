<?php

namespace App\Models;

use App\Models\Warehouse;
use App\Models\UrgentInvoice;
use App\Models\UrgentDelivery;
use App\Models\UrgentReturnItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentReturn extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(UrgentReturnItem::class, "return_id", "id");
    }

    public function get_invoice()
    {
        return $this->hasOne(UrgentInvoice::class, "id", "invoice_id");
    }

    public function deliveryOrder()
    {
        return $this->hasOne(UrgentDelivery::class, "id", "delivery_order_id");
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, "id", "location_id");
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function approvedBy()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }
}
