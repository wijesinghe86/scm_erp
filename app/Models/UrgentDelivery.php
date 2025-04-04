<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Warehouse;
use App\Models\UrgentDeliveryItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentDelivery extends Model
{
    use HasFactory;
    public function get_customer()
    {
        return $this->hasOne(Customer::class, 'id','customer_id');
    }

    public function items()
    {
        return $this->hasMany(UrgentDeliveryItem::class, 'delivery_order_id','id');
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');
    }

    public function  created_user()
    {
        return $this->hasOne(User::class, "id", "created_by");
    }
    public function urgent_invoice_items(){
        return $this->hasMany(UrgentInvoiceItem::class,'invoice_id','id');
         }
}
