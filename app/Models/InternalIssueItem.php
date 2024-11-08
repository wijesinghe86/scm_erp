<?php

namespace App\Models;

use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InternalIssueItem extends Model
{
    use HasFactory;

    public function item(){
        return $this->belongsTo(StockItem::class,'stock_no','id');//->withTrashed();
            }
}
