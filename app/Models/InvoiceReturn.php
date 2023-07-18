<?php

namespace App\Models;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceReturn extends Model
{
    use HasFactory;

    public function generateReturnOrderNumber()
    {
        $return_order_count  = self::get()->count();
        return "RMS" . sprintf('%06d', $return_order_count + 1);
    }

    public function items()
    {
        return $this->hasMany(InvoiceReturnItem::class, "return_id", "id");
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, "id", "invoice_id");
    }

    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class, "id", "delivery_order_id");
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
