<?php

namespace App\Models;

use App\Models\Supplier;
use App\Models\MrPurchaseItem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MrPurchase extends Model
{
    use HasFactory;

    public function get_supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function items()
    {
        return $this->hasMany(MrPurchaseItem::class, 'po_id', 'id' );

    }
}
