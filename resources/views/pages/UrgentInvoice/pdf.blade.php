
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
    <table style="height: 25mm">
     {{-- invoice to  --}}
        <tr>
            <td rowspan="3">
                <div style="font-size: 16px; margin-left: 10mm;">
                    <div>{{ $invoices->get_customer->customer_name }}</div>
                    {{ $invoices->get_customer->customer_address_line1 }}<br>
                    {{ $invoices->get_customer->customer_address_line2 }}<br>
                    {{ $invoices->get_customer->customer_mobile_number }}<br>
                    {{ $invoices->get_customer->customer_email }}<br>
                </div>
            </td>
            <td style="height: 8mm; width:19mm">Vat No</td>
            <td style="height: 8mm; width:24mm; text-align:center;">{{ $invoices->get_customer->customer_vat_number }}</td>
            <td style="height: 8mm; width:30mm; opacity: 0;">Date</td>
            <td style="height: 8mm; width:27mm:; text-align:right;">{{ $invoices->invoice_date }}</td>
        </tr>
        <tr>
            <td style="height: 8mm; width:19mm; opacity: 0;">Terms</td>
            <td style="height: 8mm; width:24mm; text-align:center;">{{ $invoices->payment_terms }} {{ $invoices->credit_days }}</td>
            <td style="height: 8mm; width:30mm; opacity:0;">Invoice No.</td>
            <td style="height: 8mm; width:27mm; text-align:right;">{{ $invoices->invoice_number }}</td>
        </tr>
        <tr>
            <td style="height: 8mm; width:19mm; opacity:0;">Purchase Order No.</td>
            <td style="height: 8mm; width:24mm; text-align:center">{{ $invoices->po_number }}</td>
            <td style="height: 8mm; width:30mm; opacity:0;"> D. N. No.</td>
            <td style="height: 8mm; width:27mm; text-align:right">Ref.No {{ $invoices->ref_number }}</td>
        </tr>
    </table>
  {{-- <table style="height: 6mm">
        <tr>
            <th style="width:6mm; opacity: 0;">No.</th>
            <th style="width:86mm; opacity: 0;">Description</th>
            <th style="width:14mm; opacity: 0;">U/M</th>
            <th style="width:16mm; opacity: 0;">Ord, Qty.</th>
            <th style="width:20mm; opacity: 0;">Weight</th>
            <th style="width:22.5mm; opacity: 0;">Unit Rate(Rs.)</th>
            <th style="width:32mm; opacity: 0;">Amount(Rs)</th>
        </tr>
    </table> --}}
     {{-- item table hieght --}}
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
                <td style="width:86mm; text-align:left;">{{ $item->item->description }}</td>
                <td style="width:14mm; text-align:left;">{{ $item->item->unit }}</td>
                <td style="width:16mm; text-align:left;">{{ $item->invoice_quantity }}</td>
                <td style="width:20mm; text-align:left;">{{ $item->weight }}</td>
                <td style="width:22.5mm; text-align:left;">{{ $item->unit_price }}</td>
                <td style="width:30mm; text-align:left;">{{ $item->item_value }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table>
        <tr>
            <td style="width:97mm">
                <table>
                    <tr>
                        <td class="align-top" style="width:30mm; opacity: 0; " >Prepared By:<td>
                            <td class style="width: 14mm;font-size: 13px; text-align:left;">{{ $invoices->created_user ? $invoices->created_user->name : 'User Error' }}</td>
                                {{-- <td class style="width:18mm;font-size: 13px; text-align:left;">Sales Code:<td>
                                <td class style="width: 18mm; font-size: 13px; text-align:left;">{{ $invoices->SalesStaff->employee_epf_no }}</td> --}}
                        {{-- <td>test user<td>
                            <td>Created by<td>
                                <td>test user<td>
                                    <td>Created by<td>
                                        <td>test user<td> --}}
                    </tr>
                     <tr>
                        <td class style="width: 30mm; font-size: 13px; text-align:left;">Created Date|Time:<td>
                        <td class style="width: 30mm; font-size: 13px; text-align:left;">{{ $invoices->created_at }}<td>
                    </tr>
                     <tr>
                        <td class style="width: 30mm; font-size: 13px; text-align:left;">Sales Executive:<td>
                        <td class style=" font-size: 13px; text-align:left;">{{ $invoices->SalesStaff->employee_fullname }} | {{ $invoices->SalesStaff->employee_reg_no }}<td>
                    </tr>
                   {{-- <tr>
                        <td class style="width: 30mm; font-size: 13px; text-align:left;">Reference No:<td>
                        <td class style="width: 20mm; font-size: 13px; text-align:left;">{{ $invoices->ref_number }}<td>
                    </tr>
                     --}}

                    {{-- <tr>
                        <td>created at<td>
                        <td>test user<td>
                    </tr> --}}

                </table>
            </td>
            <td style="width:10mm"></td>
            <td style="width:10mm"></td>
            <td style="width:1mm"></td>
            <td style="height:10mm;width:30mm">
                <div style="height:6px">Total(Rs.)</div></br>
                @if ($invoices->type != 1 && in_array($invoices->option, [1, 2]))
                    <div style="height:6px">Ex. Of Vat(Rs.)</div></br>
                @endif
                @if ($invoices->type != 1)
                    <div style="height:6px">Vat {{ $invoices->vat_rate }}%</div></br>
                @endif
                @if ($invoices->discount_amount > 0)
                    <div style="height:6px">Dicount(Rs.)</div></br>
                @endif
                <div style="height:6px">Grand Total(Rs.)</div></br>
            </td>
            <td style="height:10mm;width:35mm; text-align:right;">
                <div style="height:6px">
                    {{ $invoices->type == 1 ? money($invoices->grand_total) : money($invoices->sub_total) }}</div></br>
                @if ($invoices->type != 1 && $invoices->option == 1)
                    <div style="height:6px">{{ money($invoices->sub_total) }}</div></br>
                @endif
                @if ($invoices->type != 1 && $invoices->option == 2)
                    <div style="height:6px">{{ money($invoices->sub_total - $invoices->vat_amount) }}</div></br>
                @endif
                @if ($invoices->type != 1)
                    <div style="height:6px">{{ $invoices->vat_amount }}</div></br>
                @endif
                @if ($invoices->discount_amount > 0)
                    <div style="height:6px">{{ money($invoices->discount_amount) }}</div></br>
                @endif
                <div style="height:6px">{{ money($invoices->grand_total) }}</div></br>
            </td>
        </tr>
    </table>
</body>
