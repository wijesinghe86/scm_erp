<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentCreditNoteItem extends Model
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
