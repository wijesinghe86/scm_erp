@if ($invoices->status != null)
                            <div style="display: flex; justify-content: flex-end; color:red;"> <span
                                    style="font-size:16px;text-transform: uppercase"
                                    class="badge badge-primary float-right">Duplicate Print</span></div>
                        @endif
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
             /* border: 1px solid black; */
        }

    </style>
    <title>{{ $invoices->invoice_number }} | {{ $invoices->getInvoiceTypeNameAttribute() }}</title>
</head>

<body>
  {{-- header --}}
    <table style="height: 15mm">
        <tr>
            <td style="text-align:right; font-size:22px">{{ $invoices->getInvoiceTypeNameAttribute() }}</td>
            {{-- <td style="text-align:right; font-size:22px">{{ $invoices->getBillType->billtype_description }}</td> This was the first coding--}}
            {{-- <td></td> --}}
        </tr>
    </table>

    <table style="height: 20mm">
    </table>

    <table style="height: 20mm">
        <tr>
            <td rowspan="3">
                <div style="font-size: 16px; margin-left: 10mm;">
                    <div>{{ $invoices->customer->customer_name }}</div>
                    {{ $invoices->customer->customer_address_line1 }}<br>
                    {{ $invoices->customer->customer_address_line2 }}<br>
                    {{ $invoices->customer->customer_mobile_number }}<br>
                    {{ $invoices->customer->customer_email }}<br>
                    {{ $invoices->customer->customer_vat_number }}
                </div>
            </td>
            <td style="height: 8mm; width:19mm"></td>
            <td style="height: 8mm; width:24mm; text-align:center;"></td>
            <td style="height: 8mm; width:30mm; opacity: 0;">Date</td>
            <td style="height: 8mm; width:27mm:; text-align:right;">{{ $invoices->invoice_date }}</td>
        </tr>
                <td></td>
                    <td style="text-align:right;">Invoice No</td></tr>
                    <tr>
                        <td> VAt No: </td>
                        <td> PO NO: </td>
                        <td> Terms:</td>
                        <td style="text-align:right;"> Ref.No </td>
                    </tr>
                </table>
                <table style="height:109mm;">
                    <thead>
                     <tr>
                        <th style="width:6mm; opacity: 0;">No.</th>
                        <th style="width:86mm; opacity: 0;">Description</th>
                        <th style="width:14mm; opacity: 0;">U/M</th>
                        <th style="width:16mm; opacity: 0;">Ord, Qty.</th>
                        <th style="width:20mm; opacity: 0;">Weight</th>
                        <th style="width:22.5mm; opacity: 0;">Unit Rate(Rs.)</th>
                        <th style="width:32mm; opacity: 0;">Amount(Rs)</th>
                    </tr>
            
                    </thead>
                    <tbody>
                    @foreach ($invoices->items as $key => $item)
                        <tr>
                            <td style="width:6mm; text-align:left;">{{ $key + 1 }}</td>
                            <td style="width:86mm; text-align:left;">{{ $item->description }}</td>
                            <td style="width:14mm; text-align:left;">{{ $item->uom }}</td>
                            <td style="width:16mm; text-align:left;">{{ $item->quantity }}</td>
                            <td style="width:20mm; text-align:left;">{{ $item->weight }}</td>
                            <td style="width:22.5mm; text-align:left;">{{ $item->unit_price }}</td>
                            <td style="width:30mm; text-align:left;">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
