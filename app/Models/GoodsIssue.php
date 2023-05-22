<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GoodsIssue extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'customer_id',
        'ref_number',
        'issued_date',
        'issued_number',
        'status',
    ];

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function UpdateUser()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function Customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
