<?php

namespace App\Models;

use App\Models\DistributorReturn;
use App\Models\StockItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorReturnItem extends Model
{
    use HasFactory;

    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'item_id');
    }

    public function material_return()
    {
        return $this->hasOne(DistributorReturn::class, 'id', 'return_id');
    }
}
