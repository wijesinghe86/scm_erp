<?php

namespace App\Models;

use App\Models\Supplier;
use App\Models\MrPurchase;
use App\Models\PurchaseOrder;
use App\Models\GoodsReceivedItem;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GoodsReceived extends Model
{
    use HasFactory;

    public function createUser()
{
    return $this->hasOne(User::class,'id','created_by');
}
public function supplierDetails()
{
    return $this->hasOne(Supplier::class,'id','supplier_id');
}
public function poDetails()
{
    return $this->hasOne(MrPurchase::class,'id','po_id');
}

public function grnItems()
{
    return $this->hasMany(GoodsReceivedItem::class,'id','grn_id');
}

}
