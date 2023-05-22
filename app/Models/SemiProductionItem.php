<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemiProductionItem extends Model
{
    use HasFactory;
    public function item(){
        return $this->belongsTo(StockItem::class,'stock_item_id','id'); 
            }

}
