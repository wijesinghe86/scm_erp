<?php

namespace App\Models;

use App\Models\StockItem;
use App\Models\Creditnote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class credit_note_item_table extends Model
{
    use HasFactory;

    public function stockItems()
{
    return $this->hasOne(StockItem::class, 'id', 'stock_no');
}

public function credinotes()
{
    return $this->hasOne(Creditnote::class, 'id', 'credit_note_no');
}   
public function updateUser()
    {
        return $this->hasOne(User::class, 'id', 'status_updated_by');
    } 
}


