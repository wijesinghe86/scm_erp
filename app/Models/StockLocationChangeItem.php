<?php

namespace App\Models;

use App\Models\StockLocationChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockLocationChangeItem extends Model
{
    use HasFactory;


    public function stock_item()
    {
        return $this->hasOne(StockItem::class,'id','stock_item_id');
    }

    public function from_warehouse()
    {
        return $this->hasOne(Warehouse::class, "id", "from_location");
    }

    public function to_warehouse()
    {
        return $this->hasOne(Warehouse::class, "id", "to_location");
    }

    public function slc_no()
    {
        return $this->hasOne(StockLocationChange::class, "id", 'slc_id');
    }
}
