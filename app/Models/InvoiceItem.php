<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'invoice_number',
        'item_id',
        'stock_no',
        'description',
        'uom',
        'quantity',
        'unit_price',
        // 'item_discount_percentage',
        'item_discount_value',
        'item_discount_type',
        'item_discount_amount',
        'location_id',
        'sub_total',
        'total'
    ];

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');//location_id is from InvoiceItems tbl
    }
}
