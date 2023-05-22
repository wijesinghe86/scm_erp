<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'customer_id',
        'invoice_number',
        'invoice_date',
        'employee_id',
        'ref_number',
        'po_number',
        'payment_terms',
        'category',
        'type',
        'option',
        // 'item_count',
        'sub_total',
        'vat_rate',
        'vat_amount',
        'discount_type',
        "discount_amount",
        'net_total',
        'grand_total',
        'status',
        'created_by'
    ];


    protected $payment_terms = [
        [
            'value'=> "1",
            'label'=> "Cash",
        ],
        [
            'value'=> "2",
            'label'=> "Credit",
        ],
    ];


    public function createUser()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function UpdateUser()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function Customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function SalesStaff()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function Items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_number', 'invoice_number');
    }
/**
 * Calculate Discount
 *
 * @param [type] $netTotal
 * @param [type] $discount_type
 * @param [type] $discount_value
 * @return void
 */
    public function calculateDiscount($netTotal,$discount_type,$discount_value){
        $netTotal = (float) $netTotal;
        $discount_value = (float) $discount_value;

        if($discount_value== 0){
            return 0;
        }
        if($discount_type == "fixed"){
            return $discount_value;
        }

        return  ( ($netTotal/100) * $discount_value );
    }

    public function calculateTotal($invoice_number, $option, $discount_value = 0, $discount_type){
       $items = InvoiceItem::where('invoice_number', $invoice_number)->get();

       $vatRate = 15; //TODO: need to make it dynamic later
       $subtotal = $items->sum('total');
       $vat = $subtotal * ($vatRate/100);
       $exclude_vat = 0;
       if($option == "Option B"){
         $exclude_vat = $subtotal / ((100+$vatRate)/100);
         $vat = $exclude_vat * ($vatRate/100);
         $total = $subtotal;
       }
       if($exclude_vat > 0){
            $total = $subtotal;
       }else {
            $total = $subtotal + $vat;
       }

       $discount  = $this->calculateDiscount($total,$discount_type,$discount_value);
       $netTotal = $total;
       $grandTotal = $netTotal  - $discount;

       return [
        "items"=> $items,
        'exclude_vat'=>  number_format((float)$exclude_vat, 2, '.', ''),
        "vatRate"=> $vatRate."%",
        "vat"=>  number_format((float)$vat, 2, '.', ''),
        "subtotal"=>  number_format((float)$subtotal, 2, '.', ''),
        "netTotal"=> number_format((float)$netTotal, 2, '.', ''),
        "discount"=>  number_format((float)$discount, 2, '.', ''),
        "grandTotal"=> number_format((float)$grandTotal, 2, '.', ''),
       ];

    }
}
