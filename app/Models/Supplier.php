<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
    [
        'supplier_code',
        'supplier_name',
        'business_registration_number',
        'business_registration_image',
        'supplier_registration_type',
        'supplier_vat_number',
        'supplier_product_type',
        'supplier_address_line1',
        'supplier_address_line2',
        'supplier_web_address',
        'supplier_mobile_number',
        'supplier_svat_number',
        'supplier_fixedphone_number',
        'supplier_email',
        'supplier_type',
        'supplier_status',
        'supplier_contact_person_name',
        'supplier_contact_person_designation',
        'supplier_contact_person_mobile_number',
        'supplier_contact_person_email',
        'supplier_bank_name',
        'supplier_bank_branch',
        'supplier_bank_account_number',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
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
