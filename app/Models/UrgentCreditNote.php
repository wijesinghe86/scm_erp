<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentCreditNote extends Model
{
    use HasFactory;

    public function getSource(){
       
        if($this->reference_type == 'MRS'){
            $data = UrgentReturn::find($this->reference_no);
    
            $data['sourceNo'] = $data->return_no;
            return $data;
        }
        
}
public function invoice()
{
    return $this->hasOne(Invoice::class,'id','invoice_no');
}

//     public function creditItem()
// {
//     return $this->hasMany(credit_note_item_table::class,'id','credit_note_no');
// }

public function items()
{
    return $this->hasMany(UrgentCreditNoteItem::class, 'credit_note_no', 'id');
}

public function customer()
{
return $this->hasOne(Customer::class,'id', 'customer_code');
}

public function createUser()
{
    return $this->hasOne(User::class, 'id', 'created_by');
}

}