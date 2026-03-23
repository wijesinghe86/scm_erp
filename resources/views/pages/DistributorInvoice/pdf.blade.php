
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
<title>Tax Invoice</title>

<style>
    @page {
    size: A4;
    margin-top: 0.5in;
    margin-bottom: 0.2in;
    margin-left: 1in;
    margin-right: 0.5in;
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
    font-size: 28px;
    font-weight: bold;
    font-style: italic;
    letter-spacing: 1px;
    margin-bottom: 5px;
    text-transform: uppercase;

}
.company-info {
    width: 30%;
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

    .spacer {
        height: 10px;
    }

</style>
</head>

<body>

    {{-- TITLE --}}
    <div class="title-box">{{$invoices->getInvoiceTypeNameAttribute()}} </div>

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
                <strong>Supplier’s Details</strong><br>
                <strong>Supplier’s TIN:</strong>{{ $invoices->organization->organization_tin_no ?? '' }}<br>
                <strong>Supplier’s Name:</strong> {{ $invoices->organization->organization_name ?? '' }}<br>
                <strong>Address:</strong> {{ $invoices->organization->organization_address_line1 ?? '' }}<br><br>
                <strong>Telephone No:</strong> {{ $invoices->organization->organization_phone_number ?? '' }}
            </td>

            <td>
                <strong>Purchaser’s Details</strong><br>
                <strong>Purchaser’s TIN:</strong> {{ $invoices->customer->customer_tin_no ?? '' }}<br>
                <strong>Purchaser’s Name:</strong> {{ $invoices->customer->customer_name ?? '' }}<br>
                <strong>Address:</strong> {{ $invoices->customer->customer_address_line1 ?? '' }}<br><br>
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
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <!-- <th width="10%">Reference</th> -->
                <th width="60%">Description of Goods</th>
                <th width="5%" class="text-center">Quantity</th>
                <th width="15%" class="text-center">Unit Price</th>
                <th width="15%" class="text-right">Amount(Rs.)</th>
            </tr>
        </thead>

        <tbody>
            @foreach($invoices->items  as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <!-- <td>{{ $item->stock_no }}</td> -->
                <td>{{ $item->description }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->unit_price,2) }}</td>
                <td class="text-right">{{ number_format($item->sub_total,2) }}</td>
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
            </tr>
            @endfor
        </tbody>
    </table>

    {{-- TOTALS --}}
    <table>
        <tr>
            <td colspan="4"><strong>Total Value of Supply:</strong></td>
            <td class="text-right">{{ number_format($invoices->sub_total,2) }}</td>
        </tr>
        
        @if($invoices->type == 2)
<tr>
    <td colspan="4">
        <strong>VAT Amount (Total Value of Supply @ 18%)</strong>
    </td>
    <td class="text-right">
        {{ number_format($invoices->vat_amount, 2) }}
    </td>
</tr>
@endif
        </tr>
        <tr>
            <td colspan="4"><strong>Grand Total</strong></td>
            <td class="text-right">{{ number_format($invoices->grand_total,2) }}</td>
        </tr>
    </table>

    <div class="spacer"></div>

    {{-- FOOTER --}}
    <table>
        <tr>
            <td>
                <strong>Total Amount in words:</strong><br>
                {{ $invoices->grand_total_inword }}
            </td>
        </tr>
        <tr>
            <td>
                <strong>Mode of Payment:</strong> {{ $invoices->payment_terms }}
            </td>
        </tr>
    </table>
    <table>
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
    </table>

</body>
</html>