<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_order_id',
        'item_id',
        'invoice_id',
        'stock_no',
        'description',
        'uom',
        'qty',
        'available_qty',
        'issued_qty',
        'issued_date',
        'unit_price',
        'discount_percentage',
        'discount_amount',
        'sub_total',
        'total',
        'location',
        'created_by',
    ];

    public function stock_item()
    {
        return $this->hasOne(StockItem::class, 'id', 'item_id');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location');
    }
}
