<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\MrfPrfMain;
use App\Models\MaterialRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MrfPrfItem extends Model
{
    use HasFactory;

    public function item()
{
    return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');

}

public function mrf_prf()
    {
        return $this->hasOne(MrfPrfMain::class,'id','prf_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class,'approval_status_changed_by','id');
    }

    public function material_request()
    {
        return $this->hasOne(MaterialRequest::class,'id','mr_id');
    }


}


