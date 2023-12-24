<?php

namespace App\Models;

use App\Models\MrfPrfItem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MrfPrfMain extends Model
{
    use HasFactory;

    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by_id');
    }
    public function items()
    {
        return $this->hasMany(MrfPrfItem::class,'prf_id','id');
    }

    public function po_items()
    {
       return $this->hasMany(MrPurchaseItem::class, 'prf_id', 'id' );
    }




}
