<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\UrgentDelivery;
use App\Models\UrgentInvoiceItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgentInvoice extends Model
{
    use HasFactory;

    public function get_customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function getBillType()
    {
        return $this->hasOne(BillType::class, 'id', 'type');
    }

    public function location()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function  created_user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function items()
    {
        return $this->hasMany(UrgentInvoiceItem::class, 'invoice_id', 'id');
    }

     protected $payment_terms_list = [
        [
            'value' => "1",
            'label' => "Cash",
        ],
        [
            'value' => "2",
            'label' => "Credit",
        ],
    ];

    public function getPaymentTerm()
    {
        $payment_term_data = collect($this->payment_terms_list)->filter(function ($payment_term) {
            return $payment_term['value'] == $this->payment_terms;
        });
        if (count($payment_term_data) > 0) {
            return $payment_term_data[0]['label'];
        }
        return "";
    }

    public function getInvoiceTypeNameAttribute()
    {
        switch ($this->type) {
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

    public function SalesStaff()
    {
        return $this->hasOne(Employee::class, 'id', 'sales_employee_id');
    }

    public function delivery_order()
    {
        return $this->hasOne(UrgentDelivery::class, 'id', 'delivery_order_id');
    }

    public function get_delivery()
    {
        return $this->hasOne(UrgentDelivery::class, 'id', 'delivery_order_id');
    }

}
