<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerPaymentUpdate extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->hasOne(Invoice::class,'id','invoice_no');
    }

   
    public function customer()
    {
        return $this->hasOne(Customer::class,'id', 'customer_id');
    }

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}



