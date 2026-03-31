<?php

namespace App\Models;

use App\Models\Creditnote;
use App\Models\Customer;
use App\Models\DitributorDeliverOrderItem;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorDeliveryOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_code',
        'delivery_order_no',
        'invoice_id',
        'invoice_no',
        'invoice_date',
        'issued_date',
        'location_id',
        'item_id',
        'balance_order_id',
        'created_by',
        'issued_by',
        'status',
        'returned_ids',
        'vehicle_no',
        'driver_name',
        'nic_no',
        'cancel_status',
        'cancelled_by',
        'cancel_date'

    ];

    public function items()
    {
        return $this->hasMany(DitributorDeliverOrderItem::class, 'delivery_order_no', 'id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function issuedBy()
    {
        return $this->hasOne(User::class, 'id', 'issued_by');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_number', 'invoice_number');
    }


    public function generateDeliveryOrderNumber()
    {
        $delivery_order_count  = self::get()->count();
        return "DO" . sprintf('%06d', $delivery_order_count + 1);
    }

    public function creditNotes()
    {
        return $this->hasOne(Creditnote::class, 'id', 'reference_no');
    }
}
