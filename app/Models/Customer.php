<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
   use HasFactory;
   use SoftDeletes;
    protected $fillable = ['customer_code',
           'customer_name',
           'customer_vat_number',
            'customer_svat_number',
            'customer_address_line1',
            'customer_address_line2',
            'customer_type_of_customer',
           'customer_mobile_number',
            'customer_fixed_phone_number',
            'customer_email',
            'customer_payment_terms',
            'customer_credit_limit',
           'customer_credit_period',
            'customer_contact_person_name',
            'customer_contact_person_mobile_number',
            'customer_contact_person_email',
            'customer_status',
            'br_image',
            'created_by',
            'updated_by',
            'deleted_by'
];

    public function createUser()
{
    return $this->hasOne(User::class, 'id', 'created_by');
}
public function updateUser()
{
    return $this->hasOne(User::class, 'id', 'updated_by');
}
public function deleteUser()
{
    return $this->hasOne(User::class, 'id', 'deleted_by');
}


   }


