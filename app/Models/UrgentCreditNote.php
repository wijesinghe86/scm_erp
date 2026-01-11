<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentCreditNote extends Model
{
    use HasFactory;

    public function getSource(){
       
        if($this->reference_type == 'MRS'){
            $data = InvoiceReturn::find($this->reference_no);
    
            $data['sourceNo'] = $data->return_no;
            return $data;
        }
        
}
}