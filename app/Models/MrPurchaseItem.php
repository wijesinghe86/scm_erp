<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\MrfPrfMain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MrPurchaseItem extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(StockItem::class, 'item_id', 'id');
    }
    public function purchase_order()
    {
        return $this->hasOne(MrPurchase::class,'id','po_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class,'approval_status_changed_by','id');
    }

    
}
