
@php
    $debug = true; // turn OFF after alignment
@endphp

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    size: letter;
    margin: 0;
}

body {
    margin: 0;
    font-family: DejaVu Sans, sans-serif;
    font-size: 11px;
}

.sheet {
    position: relative;
    width: 216mm;
    height: 279mm;
}

/* ================= DEBUG ================= */
/* .guide {
    position: absolute;
    border: 1px dashed red;
    font-size: 7px;
    color: red;
} */
.guide span {
    position: absolute;
    top: -10px;
    left: 0;
}
@media print {
    .guide { display:none; }
}

/* ================= HEADER ================= */
.tax-label {
    position:absolute;
    top:32mm;
    left:82mm;
    width:41mm;
    height:8mm;
    text-align:center;
    font-weight:bold;
    font-size:14px;
    text-transform: uppercase;
}

/* DATE */
.date {
    position:absolute;
    top:42mm;
    left:15mm;
    width:86mm;
    font-size: 13px;
    font-weight:bold;
}

/* INVOICE NO */
.invoice-no {
    position:absolute;
    top:42mm;
    left:127mm;
    width:76mm;
    font-size: 13px;
    font-weight:bold;
}

/* ================= SUPPLIER ================= */
.supplier {
    position:absolute;
    top:48mm;
    left:15mm;
    width:86mm;
    visibility: hidden;
}

/* ================= CUSTOMER ================= */
.customer {
    position:absolute;
    top:52mm;
    left:122mm;
    width:81mm;
}

/* ================= DELIVERY ================= */
.delivery-date {
    position:absolute;
    top:83mm;
    left:29mm;
    width:72mm;
}

.place-supply {
    position:absolute;
    top:83mm;
    left:131mm;
    width:73mm;
}

/* ================= ADDITIONAL ================= */
.additional {
    position:absolute;
    top:92mm;
    left:47mm;
    width:157mm;
    height:8mm;
}

/* ================= ITEMS ================= */
.row {
    position:absolute;
    height:5.2mm;
}

/* columns */
.col-ref   { position:absolute; left:5.35mm; width:9mm; }
.col-desc  { position:absolute; left:13mm; width:83mm; }
.col-uom   { position:absolute; left:94.5mm; width:10mm; text-align:left;}
.col-qty   { position:absolute; left:103mm; width:12mm; text-align:center;}
.col-rate  { position:absolute; left:114mm; width:20mm; text-align:right;}
.col-item  { position:absolute; left:134mm; width:30mm; text-align:right;}
.col-disc  { position:absolute; left:164mm; width:10mm; text-align:center;}
.col-total { position:absolute; left:174.5mm; width:30mm; text-align:right;}

/* ================= TOTAL ================= */
.total-label {
    position: absolute;
    left: 135mm;
    width: 40mm;
    font-size: 11px;
}

.total-value {
    position: absolute;
    left: 175mm;
    width: 25mm;
    text-align: right;
    font-size: 11px;
}

.bold {
    font-weight: bold;
}

/* ================= FOOTER ================= */
.amount-words {
    position:absolute;
    top:235mm;
    left:32mm;
    width:104mm;
}

.payment {
    position:absolute;
    top:242.5mm;
    left:30mm;
}

.user {
    position:absolute;
    top:250mm;
    left:23mm;
}

.sales {
    position:absolute;
    top:250mm;
    left:6.8mm;
}
.duplicate-label {
    position: absolute;
    top: 1mm;     /* adjust if needed */
    left: 1mm;    /* left side */
    color: red;
    font-weight: bold;
    font-size: 10px;
    text-transform: uppercase;
}


</style>
</head>

<body>

<div class="sheet">
@if ($invoices->status == 'printed')
    <div class="duplicate-label">DUPLICATE INVOICE</div>
@endif

    {{-- DEBUG GUIDES --}}
    @if($debug)
        <div class="guide" style="top:32mm; left:15mm; width:86mm; height:8mm;"><span>Date</span></div>
        <div class="guide" style="top:32mm; left:127mm; width:76mm; height:8mm;"><span>Invoice No</span></div>
        <div class="guide" style="top:41mm; left:15mm; width:86mm; height:32mm;"><span>Supplier</span></div>
        <div class="guide" style="top:41mm; left:122mm; width:81mm; height:32mm;"><span>Customer</span></div>
        <div class="guide" style="top:83mm; left:47mm; width:157mm; height:8mm;"><span>Additional</span></div>
    @endif

    {{-- TAX LABEL --}}
    <div class="tax-label">{{ $invoices->getInvoiceTypeNameAttribute() }}</div>

    {{-- DATE --}}
    <div class="date">{{ $invoices->formatted_invoice_date }}</div>

    {{-- INVOICE NO --}}
    <div class="invoice-no">{{ $invoices->invoice_number }}</div>

    {{-- SUPPLIER --}}
    <div class="supplier">
        {{ $invoices->organization->organization_name }}<br>
        {{ $invoices->organization->organization_address_line1 }}<br>
        {{ $invoices->organization->organization_tin_no }}
    </div>

    {{-- CUSTOMER --}}
    <div class="customer">
        {{ $invoices->customer->customer_tin_no }}<br>
        {{ $invoices->customer->customer_name }}<br>
        {{ $invoices->customer->customer_address_line1 }}<br>
        <br>
        {{ $invoices->customer->customer_email }}<br>
        {{ $invoices->customer->customer_mobile_number }}
        
    </div>

    {{-- DELIVERY --}}
    <div class="delivery-date">{{ $invoices->formatted_invoice_date }}</div>
    <div class="place-supply">{{ $invoices->place_of_supply }}</div>

    {{-- ADDITIONAL --}}
    <div class="additional">{{ $invoices->additional_information }}</div>

    {{-- ITEMS --}}
    @foreach($invoices->items as $i => $item)
        <div class="row" style="top: {{ 110.5 + ($i * 5.2) }}mm;">
            <div class="col-ref">{{ $i+1 }}</div>
            <div class="col-desc">{{ $item->description }}</div>
            <div class="col-uom">{{ $item->uom }}</div>
            <div class="col-qty">{{ $item->quantity }}</div>
            <div class="col-rate">{{ number_format($item->unit_price,2) }}</div>
            <div class="col-item">{{ number_format($item->sub_total,2) }}</div>
            <div class="col-disc">{{ $item->item_discount_percentage }}</div>
            <div class="col-total">{{ number_format($item->total,2) }}</div>
        </div>
    @endforeach

    {{-- TOTAL --}}
    @if($invoices->type == 2)

    <div class="total-label" style="top:228mm;">Total Value of Supply</div>
    <div class="total-value bold" style="top:228mm;">
        {{ number_format($invoices->sub_total, 2) }}
    </div>

    <div class="total-label" style="top:233mm;">VAT Amount (18%)</div>
    <div class="total-value bold" style="top:233mm;">
        {{ number_format($invoices->vat_amount, 2) }}
    </div>

    <div class="total-label" style="top:238mm;">Total Amount including VAT</div>
    <div class="total-value bold" style="top:238mm;">
        {{ number_format($invoices->grand_total, 2) }}
    </div>

@else

    <div class="total-label" style="top:230mm;">Grand Total</div>
    <div class="total-value bold" style="top:230mm;">
        {{ number_format($invoices->grand_total, 2) }}
    </div>

@endif
    <!-- <div class="total-box">
        {{ number_format($invoices->grand_total,2) }}
    </div> -->

    {{-- FOOTER --}}
    <div class="amount-words">{{ $invoices->grand_total_inword }}</div>
    <div class="payment">{{ $invoices->payment_terms }} &nbsp;&nbsp;{{($invoices->credit_days)}}</div>
    <div class="user">{{ $invoices->createUser->name ?? '' }}&nbsp;|&nbsp;{{$invoices->created_at->format('H:i:s')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $invoices->SalesStaff->employee_epf_no ?? '' }}   
    </div>
    
    

</div>

</body>
</html>

