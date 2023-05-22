<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
   use SoftDeletes;
    protected $fillable =
    [
        'employee_reg_no',
        'employee_epf_no',
        'employee_fullname',
        'employee_name_with_intial',
        'residential_address_line1',
        'residential_address_line2',
        'postal_address_line1',
        'postal_address_line2',
        'date_of_birth',
        'gender',
        'civil_status',
        'employee_nic_no',
        'employee_mobile_number',
        'employee_residential_phone_number',
        'employee_email',
        'employee_type',
        'section',
        'department',
        'join_date',
        'last_date',
        'designation',
        'remark',
        'role',
        'responsibility',
        'fleet_number',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function departmentData()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }
    public function sectionData()
    {
        return $this->belongsTo(Section::class, 'section', 'id');
    }

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
