<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =
    [
        'department_number',
        'department_name',
        'department_description',
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

public function getSections()
{
    return $this->hasMany(Section::class, 'department_number', 'id');
}
}
