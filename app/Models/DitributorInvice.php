<?php

namespace App\Models;

use App\Models\BillType;
use App\Models\Creditnote;
use App\Models\Customer;
use App\Models\DeliveryOrder;
use App\Models\DitributorInviceItem;
use App\Models\Employee;
use Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;


class DitributorInvice extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'customer_id',
        'invoice_number',
        'invoice_date',
        'date_of_delivery',
        'place_of_supply',
        'additional_information',
        'organization_id',
        'employee_id',
        'ref_number',
        'po_number',
        'payment_terms',
        'category',
        'type',
        'option',
        'credit_days',
        // 'item_count',
        'sub_total',
        'vat_rate',
        'vat_amount',
        'item_discount_percentage',
        'item_discount_amount',
        'discount_type',
        'discount_amount',
        'discount',
        'net_total',
        'grand_total',
        'grand_total_inword',
        'status',
        'created_by'
        
    ];

    public function getInvoiceTypeNameAttribute()
    {
        switch ($this->type) {
            case 1:
                return 'Invoice';
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

    public function getBillType()
    {
        return $this->hasOne(BillType::class, 'id', 'type');
    }

    public function Items()
    {
        return $this->hasMany(DitributorInviceItem::class, 'invoice_id', 'id');
    }

    
    // public function DeliveryOrderNo()
    // {
    //     return $this->hasMany(DeliveryOrderItem::class, 'id', 'invoice_id');
    // }

    /**
     * Calculate Discount
     *
     * @param [type] $netTotal
     * @param [type] $discount_type
     * @param [type] $discount_value
     * @return void
     */
    public function calculateDiscount($netTotal, $discount_type, $discount_value)
    {
        $netTotal = (float) $netTotal;
        $discount_value = (float) $discount_value;

        if ($discount_value == 0) {
            return 0;
        }
        if ($discount_type == "fixed") {
            return $discount_value;
        }
        return (($netTotal / 100) * $discount_value);
    }

    public function calculateTotal($invoice_number, $option, $discount_value = 0, $discount_type)
    {
        // logger($option);
        $cartCollection =  Cart::session(request()->user()->id)->getContent();
        $items = $cartCollection->sortBy(function ($product, $key) {
            return $key;
        });

        $total_item_discount = $items->sum('attributes.item_discount_amount');

        $vatRate = 18; //TODO: need to make it dynamic later
        //    $subtotal = $items->sum('total');
        $subtotal = Cart::session(request()->user()->id)->getSubTotal() - $total_item_discount;
        $vat = round($subtotal * ($vatRate / 100));
        $exclude_vat = 0;

        if ($option == "None" || $option == 0 || $option == "0") {
            $total = $subtotal;
            $vat = 0;
            $vatRate = 0;
        }

        if ($option == "Option B" || $option == 2 || $option == "2") {
            $exclude_vat = $subtotal / ((100 + $vatRate) / 100);
            $vat = round($exclude_vat * ($vatRate / 100));
            $total = $subtotal;
        }
        if ($exclude_vat > 0) {
            $total = $subtotal;
        } else {
            $total = round($subtotal + $vat);
        }

        $discount  = $this->calculateDiscount($total, $discount_type, $discount_value);
        $netTotal = $total;
        $grandTotal = round($netTotal  - (float) $discount);

        return [
            "items" => $items,
            'exclude_vat' =>  number_format((float)$exclude_vat, 2, '.', ''),
            "vatRate" => $vatRate . "%",
            "vat" =>  number_format((float)$vat, 2, '.', ''),
            "subtotal" =>  number_format((float)$subtotal, 2, '.', ''),
            "netTotal" => number_format((float)$netTotal, 2, '.', ''),
            "discount" =>  number_format((float)$discount, 2, '.', ''),
            "grandTotal" => number_format((float)$grandTotal, 2, '.', ''),
        ];
    }

    public function credit_notes()
    {
        return $this->hasMany(Creditnote::class,'invoice_no','id');
    }

    public function delivery_orders()
    {
        return $this->hasMany(DeliveryOrder::class, 'invoice_number', 'invoice_number');  
    }

    public function organization()
{
    return $this->belongsTo(Organization::class, 'organization_id');
}

public function getFormattedInvoiceDateAttribute()
{
    return \Carbon\Carbon::parse($this->invoice_date)->format('m/d/Y');
}

// New Invoice No generation start here 21.03.2026
public static function generateInvoiceNumber($request)
{
    $organization = Organization::find($request->organization_id);
    $orgCode = strtoupper($organization?->organization_code ?? 'ORG');

    $date = \Carbon\Carbon::parse($request->invoice_date);
    $datePart = strtoupper($date->format('yM'));

    $typePrefix = match ((int)$request->invoice_type) {
        1 => 'IN',
        2 => 'TI',
        default => 'IN',
    };

    // ✅ base WITHOUT date
    $base = "{$orgCode}{$typePrefix}";

  
    // 🔒 Lock ONLY relevant rows safely
    $lastInvoice = self::where('organization_id', $request->organization_id)
        ->where('type', $request->invoice_type)
        ->lockForUpdate()
        ->orderBy('id', 'desc')
        ->first();

    if ($lastInvoice) {
        $lastSeq = (int) substr($lastInvoice->invoice_number, -5);
        $nextSeq = $lastSeq + 1;
    } else {
        $nextSeq = 1;
    }

    return "{$datePart}_{$base}_" . sprintf('%05d', $nextSeq);
}
}