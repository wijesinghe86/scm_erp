<?php

namespace App\Models;

use App\Models\DistributorBalanceOrder;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorBalanceOrderItem extends Model
{
    use HasFactory;
    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'item_id');
    }

    public function balance_order()
    {
        return $this->hasOne(DistributorBalanceOrder::class, 'id', 'balance_order_id' );
    }
}
