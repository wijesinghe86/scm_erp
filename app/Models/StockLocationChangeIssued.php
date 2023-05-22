<?php

namespace App\Models;

use App\Models\StockLocationChange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockLocationChangeIssued extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'slc_number',
        'item_id',
        'stock_no',
        'description',
        'uom',
        'iss_qty',
        'location_id',
        'issued_by',
        'iss_date'
    ];

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');//location_id is from InvoiceItems tbl
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
