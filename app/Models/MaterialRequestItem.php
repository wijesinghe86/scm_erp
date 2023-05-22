<?php

namespace App\Models;


use App\Models\MrApproved;
use App\Models\StockItem;
use App\Models\MaterialRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialRequestItem extends Model
{
    use HasFactory;

    public function item(){
        return $this->belongsTo(StockItem::class,'stock_item_id','id');//->withTrashed();
            }
    public function materialRequest()
    {
         return $this->belongsTo(MaterialRequest::class, 'mr_id', 'id');
            }

    public function approval()
        {
        return $this->hasMany(MrApproved::class,'mr_item_id','id');
        }

    public function approval_production()
        {
        return $this->hasMany(MrApproved::class,'mr_item_id','id')->where('approved_for','production');
        }

    public function approval_purchase()
        {
        return $this->hasMany(MrApproved::class,'mr_item_id','id')->where('approved_for','purchase');
        }


    public function scopeApprovedForProduction($q)
    {
        return $q->whereHas('approval_production');

    }

    public function scopeApprovedForPurchase($q)
    {
        return $q->whereHas('approval_purchase');

    }

}




