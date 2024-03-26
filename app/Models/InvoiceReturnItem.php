<?php

namespace App\Models;

use App\Models\StockItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceReturnItem extends Model
{
    use HasFactory;


    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'item_id');
    }
}



