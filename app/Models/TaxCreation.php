<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TaxCreation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
    [
        'tax_code',
        'tax_name',
        'tax_rate',
        'tax_description',
        'start_date',
        'expire_date',
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
