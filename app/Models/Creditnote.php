<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\BalanceOrder;
use App\Models\DeliveryOrder;
use App\Models\InvoiceReturn;
use App\Models\credit_note_item_table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Creditnote extends Model
{
    use HasFactory;


public function getSource(){
    if($this->reference_type == 'DO'){
        $data = DeliveryOrder::find($this->reference_no);

        $data['sourceNo'] = $data->delivery_order_no;
        return $data;
    }
    if($this->reference_type == 'MRS'){
        $data = InvoiceReturn::find($this->reference_no);

        $data['sourceNo'] = $data->return_no;
        return $data;
    }
    if($this->reference_type == 'BO'){
        $data = BalanceOrder::find($this->reference_no);

        $data['sourceNo'] = $data->balance_order_no;
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
        return $this->hasMany(credit_note_item_table::class, 'credit_note_no', 'id');
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
