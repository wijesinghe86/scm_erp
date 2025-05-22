<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentInvoiceItem extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsTo(StockItem::class, 'item_id', 'id');

    }
}
