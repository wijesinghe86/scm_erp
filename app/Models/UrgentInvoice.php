<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentInvoice extends Model
{
    use HasFactory;

    public function get_customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function getBillType()
    {
        return $this->hasOne(BillType::class, 'id', 'type');
    }
}
