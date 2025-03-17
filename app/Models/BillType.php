<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    use HasFactory;
    protected $fillable = [
        'billtype_code',
        'billtype_description',
        'invoice_no',
        'created_by',
        'type'
    ];

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
