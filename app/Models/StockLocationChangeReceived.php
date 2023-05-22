<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLocationChangeReceived extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'slc_number',
        'item_id',
        'stock_no',
        'description',
        'uom',
        'revd_qty',
        'location_id',
        'received_by',
        'rec_date'
    ];

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id'); //location_id is from InvoiceItems tbl
    }

    public function item()
    {
        return $this->belongsTo(StockItem::class,'item_id','id');//->withTrashed();
    }

    public function StockLocationChange()
    {
         return $this->belongsTo(StockLocationChange::class, 'slc_id', 'id');
    }
}
