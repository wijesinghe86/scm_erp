<?php

namespace App\Models;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiscellaneousReceivedItem extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'misc_number',
        'item_id',
        'stock_no',
        'description',
        'uom',
        'revd_qty',
        'revd_weight',
        'location_id',
        'created_by'
    ];

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'location_id');//location_id is from InvoiceItems tbl
    }
}
