<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentDelivery extends Model
{
    use HasFactory;
    public function get_customer()
    {
        return $this->hasOne(Customer::class, 'id','customer_id');
    }
}
