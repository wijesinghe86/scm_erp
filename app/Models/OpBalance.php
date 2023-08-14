<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpBalance extends Model
{
    use HasFactory;

    public function createdBy()
    {
        return $this->hasOne(User::class,'id','created_by');
    }

    public function deleteddBy()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
}
