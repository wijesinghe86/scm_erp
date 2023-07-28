<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        table {
            width: 100%;
            /* border-collapse: collapse; */
            /* border: 1px solid black; */
            margin: 0;
            padding: 0;
            font-size: 15px;
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
  {{-- header --}}
    <table style="height: 15mm">
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table style="height: 25mm">
        {{-- invoice to --}}
        <tr>
            <td rowspan="3">
                <div style="margin-left: 10mm;">
                    <div>{{ $invoices->customer->customer_name }}</div>
                    <small>{{ $invoices->customer->customer_address_line1 }}</small><br>
                    <small>{{ $invoices->customer->customer_address_line2 }}</small><br>
                    <small>{{ $invoices->customer->customer_mobile_number }}</small><br>
                    <small>{{ $invoices->customer->customer_email }}</small><br>
                </div>
            </td>
            <td style="height: 8mm; width:19mm">Vat No</td>
            <td style="height: 8mm; width:24mm; text-align:center;">{{ $invoices->customer->customer_vat_number }}</td>
            <td style="height: 8mm; width:30mm; opacity: 0;">Date</td>
            <td style="height: 8mm; width:27mm:; text-align:center;">{{ $invoices->invoice_date }}</td>
        </tr>
        <tr>
            <td style="height: 8mm; width:19mm; opacity: 0;">Terms</td>
            <td style="height: 8mm; width:24mm; text-align:center;">{{ $invoices->payment_terms }}</td>
            <td style="height: 8mm; width:30mm; opacity:0;">Invoice No.</td>
            <td style="height: 8mm; width:27mm; text-align:center;">{{ $invoices->invoice_number }}</td>
        </tr>
        <tr>
            <td style="height: 8mm; width:19mm; opacity:0;">Purchanse Order No.</td>
            <td style="height: 8mm; width:24mm; text-align:center;">{{ $invoices->po_number }}</td>
            <td style="height: 8mm; width:30mm; opacity:0;">D. N. No.</td>
            <td style="height: 8mm; width:27mm; text-align:center;">{{ $invoices->po_number }}</td>
        </tr>
    </table>
  <table style="height: 6mm">
        <tr>
            <th style="width:6mm; opacity: 0;">No.</th>
            <th style="width:86mm; opacity: 0;">Description</th>
            <th style="width:14mm; opacity: 0;">U/M</th>
            <th style="width:16mm; opacity: 0;">Ord, Qty.</th>
            <th style="width:20mm; opacity: 0;">Weight</th>
            <th style="width:22.5mm; opacity: 0;">Unit Rate(Rs.)</th>
            <th style="width:32mm; opacity: 0;">Amount(Rs)</th>
        </tr>
    </table>
     {{-- item table hieght --}}
    <table style="height:100mm;">
        {{-- <thead>

        </thead> --}}
        <tbody>
        @foreach ($invoices->items as $key => $item)
            <tr>
                <td style="width:6mm">{{ $key + 1 }}</td>
                <td style="width:86mm">{{ $item->description }}</td>
                <td style="width:14mm">{{ $item->uom }}</td>
                <td style="width:16mm">{{ $item->quantity }}</td>
                <td style="width:20mm">{{ $item->uom }}</td>
                <td style="width:22.5mm">{{ $item->unit_price }}</td>
                <td style="width:32mm">{{ $item->total }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table>
        <tr>
            <td style="width:97mm">
                <table>
                    <tr>
                        <td class="align-top" style="opacity: 0; " >Prepared By:<td>
                            <td>{{ $invoices->createUser ? $invoices->createUser->name : 'User Error' }}</td>
                                <td>Sales Code<td>
                                <td>{{ $invoices->SalesStaff->employee_epf_no }}</td>
                        {{-- <td>test user<td>
                            <td>Created by<td>
                                <td>test user<td>
                                    <td>Created by<td>
                                        <td>test user<td> --}}
                    </tr>
                     <tr>
                        <td>Created Date:<td>
                        <td>{{ $invoices->created_at }}<td>
                    </tr>
                    {{-- <tr>
                        <td>created at<td>
                        <td>test user<td>
                    </tr> --}}

                </table>
            </td>
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
