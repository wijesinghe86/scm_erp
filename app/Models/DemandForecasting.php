<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandForecasting extends Model
{
    use HasFactory;
    public function createUser()
{
    return $this->hasOne(User::class, 'id', 'created_by');
}

}
