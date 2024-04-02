<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\BalanceOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BalanceOrderItem extends Model
{
    use HasFactory, SoftDeletes;

    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'item_id');
    }

    public function balance_order()
    {
        return $this->hasOne(BalanceOrder::class, 'id', 'balance_order_id' );
    }
}
