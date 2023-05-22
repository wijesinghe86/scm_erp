<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =['warehouse_code',
    'warehouse_name',
    'description',
    'warehouse_height',
    'warehouse_width',
    'warehouse_length',
    'warehouse_floor_area',
    'warehouse_status',
    'created_by',
    'updated_by',
    'deleted_by'];

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
