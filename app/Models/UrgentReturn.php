<?php

namespace App\Models;

use App\Models\UrgentDelivery;
use App\Models\UrgentInvoice;
use App\Models\UrgentReturnItem;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentReturn extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(UrgentReturnItem::class, "return_id", "id");
    }

    public function get_invoice()
    {
        return $this->belongsTo(UrgentInvoice::class, "invoice_id");
        // return $this->hasOne(UrgentInvoice::class, "id", "invoice_id");
    }

    public function deliveryOrder()
    {
        return $this->belongsTo(UrgentDelivery::class, "delivery_order_id");
        // return $this->hasOne(UrgentDelivery::class, "id", "delivery_order_id");
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, "id", "location_id");
        // return $this->hasOne(Warehouse::class, "id", "location_id");
    }

    public function createdBy()
    {
        // return $this->hasOne(User::class, 'id', 'created_by');
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
        // return $this->hasOne(User::class, 'id', 'approved_by');
    }
}
