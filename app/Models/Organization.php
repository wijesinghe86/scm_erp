<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_code',
        'organization_name',
        'organization_tin_no',
        'organization_address_line1',
        'organization_address_line2',
        'organization_phone_number',
        'organization_whatsapp_number',
        'organization_email',
        'organization_contact_person_name',
        'organization_contact_person_phone',
        'remarks',
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
