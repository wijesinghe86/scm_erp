<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceOrder extends Model
{
    use HasFactory, SoftDeletes;

    public function generateBalanceOrderNumber()
    {
        $invoice_count = self::get()->count();
        return "BO" . sprintf('%06d', $invoice_count + 1);
    }

    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class, 'id', 'delivery_order_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_number', 'invoice_number');
    }

    public function items()
    {
        return $this->hasMany(BalanceOrderItem::class, 'balance_order_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');
    }
}
