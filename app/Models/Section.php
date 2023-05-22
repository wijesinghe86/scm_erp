<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Section extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
    [
        'section_number',
        'department_number',
        'section_name',
        'section_description',
        'remark',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

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
