<?php

namespace App\Models;

use App\Models\DistributorBalanceOrderItem;
use App\Models\DistributorDeliveryOrder;
use App\Models\DitributorInvice;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorBalanceOrder extends Model
{
    use HasFactory;
    public function generateBalanceOrderNumber()
    {
        $invoice_count = self::get()->count();
        return "BO" . sprintf('%06d', $invoice_count + 1);
    }

    public function deliveryOrder()
    {
        return $this->hasOne(DistributorDeliveryOrder::class, 'id', 'delivery_order_id');
    }

    public function invoice()
    {
        return $this->hasOne(DitributorInvice::class, 'invoice_number', 'invoice_number');
    }

    public function items()
    {
        return $this->hasMany(DistributorBalanceOrderItem::class, 'balance_order_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');
    }
    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
