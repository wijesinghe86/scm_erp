<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'invoice_type',
        'invoice_category',
        'invoice_option',
        'updated_by'
    ];

    protected $appends =
    [
        'invoice_type_name',
    ];

    public function getInvoiceTypeNameAttribute()
    {
        switch ($this->invoice_type) {
            case 1:
                return 'Non Tax Invoice';
                break;
            case 2:
                return 'Tax Invoice';
                break;
            case 3:
                return 'Suspended Tax Invoice';
                break;
            default:
                return 'N/A';
                break;
        }
    }

    // public function calVatIncludedProduct($invoice_number){
    //     return 10;
    // }
    // public function calculateTax($invoice_number){
    //     // $total  =  InvoiceItem::where('invoice_number', $invoice_number)->sum('total');
    //     switch($this->invoice_option){
    //         case 1:
    //             return $this->calVatIncludedProduct($invoice_number);
    //         break;
    //         case 2:
    //             return 20;
    //         break;
    //         case 3:
    //             return 30;
    //         break;
    //     }
    //    //
    // }
    
    public function category()
    {
        return $this->hasOne(BillType::class, 'id', 'invoice_category');
    }

    public function InvoiceOption($invoice_number){
            switch($this->invoice_option){
                case 0:
                    return 'None';
                break;
                case 1:
                    return 'Option A';
                break;
                case 2:
                    return 'Option B';
                break;
                case 3:
                    return 'Option C';
                break;
            }
           //
        }
}
