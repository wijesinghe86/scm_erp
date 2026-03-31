
@if ($invoices->status == 'printed')
                            <div style="display: flex; justify-content: flex-end; color:red;"> <span
                                    style="font-size:14px;text-transform: uppercase"
                                    class="badge badge-primary float-right">Duplicate Print</span></div>
                        @endif


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<table class="header-table">
    <tr>
        <!-- LOGO -->
        <td class="logo-cell">
            <div class="logo-placeholder"></div>
        </td>

        <!-- COMPANY NAME -->
        <td class="company-cell">
            <div class="company-name">
                {{ strtoupper($invoices->organization->organization_name ?? 'YOUR COMPANY NAME') }}
            </div>
        </td>

        <!-- RIGHT DETAILS -->
        <td class="company-info">
            <div><strong>VAT No:</strong> {{ $invoices->organization->organization_tin_no ?? '' }}</div>
            <div><strong>Email:</strong> {{ $invoices->organization->organization_email ?? '' }}</div>
            <div><strong>Web:</strong> {{ $invoices->organization->remarks ?? '' }}</div>
        </td>
    </tr>
</table>
<!-- <title>Tax Invoice</title> -->

<style>
    @page {
    size: A4;
    margin-top: 0.4in;
    margin-bottom: 0.2in;
    margin-left: 0.5in;
    margin-right: 0.2in;
}
.header-table {
    width: 100%;
    border: none;
    margin-bottom: 5px;
}

.header-table td {
    border: none;
    vertical-align: middle;
}

.logo-cell {
    width: 15%;
    text-align: left;
    border: #000;
}

.company-cell {
    width: 55%;
    text-align: center;
}

.logo {
    height: 60px; /* adjust as needed */
}
.logo-placeholder {
    width: 60px;
    height: 60px;
    border: 1px solid black;
}
.company-name {
    text-align: left;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-size: 25px;
    font-weight: bold;
    font-style: italic;
    letter-spacing: 1px;
    margin-bottom: 5px;
    text-transform: uppercase;

}
.company-info {
    width: 40%;
    text-align: left;
    font-size: 11px;
    line-height: 1.4;
}

   
body {
    margin: 0;
    padding: 0;
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
}
    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    td, th {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

    td, th {
        
        border: 1px solid #000;
        padding: 6px;
        vertical-align: top;
    }

    .no-border {
        border: none !important;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .title-box {
        width: 200px;
        margin: 0 auto;
        text-align: center;
        border: 1px solid #000;
        font-weight: bold;
        padding: 5px;
    }

    /* .spacer {
        height: 10px;
    } */
    .items-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #000; /* outer border */
    font-size: 12px;
   
}
.items-table td {
    white-space: nowrap;
    font-size: 12px;
}

/* HEADER - FULL GRID */
.items-table thead th {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
    font-size: 10px;
}

/* BODY - ONLY VERTICAL LINES */
.items-table tbody td {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-top: none;
    border-bottom: none;
    padding: 6px;
}

/* Ensure last column right border shows */
.items-table tbody td:last-child {
    border-right: 1px solid #000;
}

/* Ensure first column left border */
.items-table tbody td:first-child {
    border-left: 1px solid #000;
}
.totals-table-final {
    width: 100%;
    border-collapse: collapse;
    margin-top: 0; /* 🔥 REMOVE SPACE */
}

.totals-table-final td {
    padding: 6px;
}

/* LEFT WHITE SPACE (NO LINES AT ALL) */
.totals-table-final .blank {
    width: 60%;
    border: none !important; /* 🔥 REMOVE ALL LINES */
    border-left: 1px solid #000 !important; /* ✅ ONLY LEFT BORDER */

}

/* LABEL COLUMN */
.totals-table-final .label {
    width: 25%;
    border: 1px solid #000;
    text-align: left;
    font-weight: bold;
}

/* VALUE COLUMN */
.totals-table-final .value {
    width: 15%;
    border: 1px solid #000;
    text-align: right;
}
</style>
</head>

<body>

    {{-- TITLE --}}
    <div class="title-box">{{strtoupper($invoices->getInvoiceTypeNameAttribute())}} </div>

    <div class="spacer"></div>

    {{-- HEADER --}}
    <table>
        <tr>
            <td width="50%">
                <strong>Date of Invoice:</strong> {{ $invoices->formatted_invoice_date }}
            </td>
            <td width="50%">
                <strong>Invoice No:</strong> {{ $invoices->invoice_number }}
            </td>
        </tr>

        <tr>
            <td>
            <div style="text-align: center;">
                <strong>Supplier’s Details</strong></div>
                <strong>Supplier’s TIN:</strong>{{ $invoices->organization->organization_tin_no ?? '' }}<br>
                <strong>Supplier’s Name:</strong> {{ strtoupper ($invoices->organization->organization_name ?? '') }}<br>
                <strong>Address:</strong> {{  strtoupper ($invoices->organization->organization_address_line1 ?? '') }}<br><br>
                <strong>Telephone No:</strong> {{ $invoices->organization->organization_phone_number ?? '' }}
            </td>

            <td>
            <div style="text-align: center;">
                <strong>Purchaser’s Details</strong></div>
                <strong>Purchaser’s TIN:</strong> {{ $invoices->customer->customer_tin_no ?? '' }} <br>
                <strong>Purchaser’s VAT No:</strong> {{ $invoices->customer->customer_vat_number ?? '' }}<br>
                <strong>Purchaser’s Name:</strong> {{ strtoupper($invoices->customer->customer_name ?? '' )}}<br>
                <strong>Address:</strong> {{ strtoupper($invoices->customer->customer_address_line1 ?? '') }}<br><br>
                <strong>Telephone No:</strong> {{ $invoices->customer->customer_phone ?? '' }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Date of Delivery:</strong> {{ \Carbon\Carbon::parse($invoices->invoice_date)->format('m/d/Y')  }}
            </td>
            <td>
                <strong>Place of Supply:</strong> {{ $invoices->place_of_supply }}
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <strong>Additional Information if any:</strong><br>
                {{ $invoices->additional_information }}
            </td>
        </tr>
    </table>

    <div class="spacer"></div>

    {{-- ITEMS TABLE --}}
    <table class="items-table">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="42%">Description of Goods</th>
                <th width="6%">U/M</th>
                <th width="7%" class="text-center">Ord Qty</th>
                <th width="9%" class="text-left">Unit Rate</th>
                <th width="12%" class="text-left">Item Amount(Rs)</th>
                <th width="8%" class="text-left">Item Dicount %</th>
                @if($invoices->type == 2)
                <th width="12%" class="text-left">Ex.of VAT Amount(Rs)</th>
                @else
                <th width="12%" class="text-right">Amount(Rs)</th>
            </tr>
            @endif
        </thead>

        <tbody>
            @foreach($invoices->items  as $key => $item)
            <tr>
                <td class="text-left">{{ $key + 1 }}</td>
                <td class="text-left">{{ $item->description }}</td>
                <td class="text-left">{{ $item->uom }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->unit_price,2) }}</td>
                <td class="text-right">{{ number_format($item->sub_total,2) }}</td>
                <td class="text-center">{{ number_format($item->item_discount_percentage) }}</td>
                <td class="text-right">{{ number_format($item->total,2) }}</td>

            </tr>
            @endforeach

            {{-- EMPTY ROWS to match design --}}
            @for($i = count($invoices->items); $i < 10; $i++)
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endfor
        </tbody>
    </table>

    {{-- TOTALS --}}
    <table class="totals-table-final">
    <tr>
        <td class="blank" rowspan="{{ $invoices->type == 2 ? 3 : 2 }}"><strong>Note:</strong><br>
        CHEQUES TO BE DRAWN IN FAVOUR OF “JANATHA STEELS” AND CROSSED “A/C PAYEE ONLY”</td>
        <td class="label">Total Value of Supply</td>
        <td class="value">{{ number_format($invoices->sub_total, 2) }}</td>
    </tr>

    @if($invoices->type == 2)
    <tr>
        <td class="label">VAT Amount (18%)</td>
        <td class="value">{{ number_format($invoices->vat_amount, 2) }}</td>
    </tr>
    @endif

    <tr>
        <td class="label">
            {{ $invoices->type == 2 ? 'Total Amount including VAT' : 'Grand Total' }}
        </td>
        <td class="value">
            <strong>{{ number_format($invoices->grand_total, 2) }}</strong>
        </td>
    </tr>
</table>

    <!-- <div class="spacer"></div> -->

    {{-- FOOTER --}}
    <table>
        <tr>
            <td>
                <strong>Total Amount in words:</strong>{{ $invoices->grand_total_inword }}
              
            </td>
        </tr>
        <tr>
            <td>
                <strong>Mode of Payment:</strong> {{ $invoices->payment_terms }} {{$invoices->credit_days}}
                <strong>Prepared by:</strong>{{ $invoices->createUser ? $invoices->createUser->name : 'User Error'}} | 
                <strong>Sales Code:</strong> {{ $invoices->SalesStaff->employee_epf_no }} | 
                <strong>Date|Time:</strong>{{ $invoices->created_at }} 
            </td>
        </tr>
    </table>
    <!-- <table>
        <head>
            <tr>
                <td>Prepared by:</td>
                <td>Sales Code:</td>
                <td>Date|Time:</td>
            </tr>
        </head>
        <tbody>
            <tr>
                <td>{{ $invoices->createUser ? $invoices->createUser->name : 'User Error'}}</td>
                <td>{{ $invoices->SalesStaff->employee_epf_no }}</td>
                <td>{{ $invoices->created_at }}</td>

            </tr>
        </tbody>
    </table> -->

</body>
</html>