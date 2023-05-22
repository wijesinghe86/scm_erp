<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchasingRequest extends Model
{
    use HasFactory;

    public function createUser()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}


