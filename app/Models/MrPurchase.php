<?php

namespace App\Models;

use App\Models\Supplier;
use App\Models\MrfPrfMain;
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
        return $this->hasMany(MrPurchaseItem::class,'po_id', 'id');
    }

    public function purchase_request_id()
    {
        return $this->hasOne(MrfPrfMain::class, 'id', 'prf_id');
    }

    public function grn_items()
    {
       return $this->hasMany(GoodsReceivedItem::class, 'po_id', 'id' );
    }




}
