<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EquipmentRegistration extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =[
        'equipment_code',
        'stock_number',
        'equipment_name',
        'po_number',
        'grn_number',
        'equipment_description',
        'equipment_type',
        'power_source',
        'created_by',
        'updated_by',
        'deleted_by'];

        public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function UpdateUser()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function deleteUser()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
