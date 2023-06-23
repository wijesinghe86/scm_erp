<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        table {
            width: 100%;
            /* border-collapse: collapse; */
            border: 1px solid black;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }

        th {
            text-align: left;
        }

        td,
        th {
            border: 1px solid black;
        }
    </style>
    <title>{{ $invoices->invoice_number }} | {{ $invoices->getInvoiceTypeNameAttribute() }}</title>
</head>

<body>
    <table style="height: 30mm">
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table style="height: 25mm">
        <tr>
            <td rowspan="3">
                <div style="margin-left: 18mm">
                    <div>{{ $invoices->customer->customer_name }}</div>
                    <small>{{ $invoices->customer->customer_address_line1 }}</small><br>
                    <small>{{ $invoices->customer->customer_address_line2 }}</small><br>
                    <small>{{ $invoices->customer->customer_mobile_number }}</small><br>
                    <small>{{ $invoices->customer->customer_email }}</small><br>
                </div>
            </td>
            <td style="height: 8mm; width:26mm">Vat No</td>
            <td style="height: 8mm; width:36mm">{{ $invoices->customer->customer_vat_number }}</td>
            <td style="height: 8mm; width:22.5mm">Date</td>
            <td style="height: 8mm; width:32mm">{{ $invoices->invoice_date }}</td>
        </tr>
        <tr>
            <td style="height: 8mm; width:26mm">Terms</td>
            <td style="height: 8mm; width:36mm">{{ $invoices->payment_terms }}</td>
            <td style="height: 8mm; width:22.5mm">Invoice No.</td>
            <td style="height: 8mm; width:32mm">{{ $invoices->invoice_number }}</td>
        </tr>
        <tr>
            <td style="height: 8mm; width:26mm">Purchanse Order No.</td>
            <td style="height: 8mm; width:36mm">{{ $invoices->po_number }}</td>
            <td style="height: 8mm; width:22.5mm">D. N. No.</td>
            <td style="height: 8mm; width:32mm">{{ $invoices->po_number }}</td>
        </tr>
    </table>
    <table style="height: 6mm">
        <tr>
            <th style="width:11mm">No.</th>
            <th style="width:86mm">Description</th>
            <th style="width:14mm">U/M</th>
            <th style="width:16mm">Ord, Qty.</th>
            <th style="width:20mm">Weight</th>
            <th style="width:22.5mm">Unit Rate(Rs.)</th>
            <th style="width:32mm">Amount(Rs)</th>
        </tr>
    </table>
    <table style="height:105mm;">
        @foreach ($invoices->items as $key => $item)
            <tr>
                <td style="width:11mm">{{ $key + 1 }}</td>
                <td style="width:86mm">{{ $item->description }}</td>
                <td style="width:14mm">{{ $item->uom }}</td>
                <td style="width:16mm">{{ $item->quantity }}</td>
                <td style="width:20mm">{{ $item->uom }}</td>
                <td style="width:22.5mm">{{ $item->unit_price }}</td>
                <td style="width:32mm">{{ $item->total }}</td>
            </tr>
        @endforeach
    </table>
    <table>
        <tr>
            <td style="width:11mm"></td>
            <td style="width:86mm"></td>
            <td style="width:14mm"></td>
            <td style="width:16mm"></td>
            <td style="width:20mm"></td>
            <td style="height:26mm;width:22.5mm">
                <div style="height:7px">Total(Rs.)</div></br>
                @if ($invoices->type != 1 && in_array($invoices->option, [1, 2]))
                    <div style="height:7px">Ex. Of Vat(Rs.)</div></br>
                @endif
                @if ($invoices->type != 1)
                    <div style="height:7px">Vat {{ $invoices->vat_rate }}%</div></br>
                @endif
                @if ($invoices->discount_amount > 0)
                    <div style="height:7px">Dicount(Rs.)</div></br>
                @endif
                <div style="height:7px">Grand Total(Rs.)</div></br>
            </td>
            <td style="height:26mm;width:32mm">
                <div style="height:7px">
                    {{ $invoices->type == 1 ? money($invoices->grand_total) : money($invoices->sub_total) }}</div></br>
                @if ($invoices->type != 1 && $invoices->option == 1)
                    <div style="height:7px">{{ money($invoices->sub_total) }}</div></br>
                @endif
                @if ($invoices->type != 1 && $invoices->option == 2)
                    <div style="height:7px">{{ money($invoices->sub_total - $invoices->vat_amount) }}</div></br>
                @endif
                @if ($invoices->type != 1)
                    <div style="height:7px">{{ $invoices->vat_rate }}</div></br>
                @endif
                @if ($invoices->discount_amount > 0)
                    <div style="height:7px">{{ money($invoices->discount_amount) }}</div></br>
                @endif
                <div style="height:7px">{{ money($invoices->grand_total) }}</div></br>
            </td>
        </tr>
    </table>
</body>
