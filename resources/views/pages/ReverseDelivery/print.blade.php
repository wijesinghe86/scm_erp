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
    <title>{{ $urgent_delivery->delivery_order_no }}</title>
</head>

<body>
    <table style="height: 9mm;">
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="4">
                <div style="margin-left: 20px">
                    {{ (optional($urgent_delivery)->get_customer)->customer_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vehicle No:{{$urgent_delivery->vehicle_no}}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NIC No:{{$urgent_delivery->nic_no}}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="margin-left: 75px; text-align:left;">{{ $urgent_delivery->issued_date}}</div>
            </td>
            <td>
                <div style="margin-left: 20px; text-align:left;">{{$urgent_delivery->delivery_order_no}}</div>
            </td>
            <td>
                <div style="margin-left: 20px; text-align:right;">{{ $urgent_delivery->delivery_order_no }}</div>
            </td>
            <td>
                <div style="margin-left: 20px; text-align:right;">{{ $urgent_delivery->location->warehouse_name }}</div>
            </td>
        </tr>

    </table>
    <table style="height: 8mm">
        <tr></tr>
    </table>
    <table style="height:80mm">
        @foreach ($urgent_delivery->items as $issued_items)

            <tr>

                <td style="width:4mm">{{$loop->iteration}}</td>
                <td style="width:13mm">{{ optional($issued_items->item)->stock_number }}</td>
                <td style="width:95mm">{{ optional($issued_items->item)->description }}</td>
                <td style="width:15mm">{{ optional($issued_items->item)->unit }}</td>
                <td style="width:25mm">{{ optional($issued_items)->issued_qty }}</td>
                <td style="width:25mm">{{ optional($issued_items)->issued_qty }}</td>
                <td style="width:25mm">{{ optional($urgent_delivery->location)->warehouse_name }}</td>
            </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <td style="width:100%"></td>
            {{-- <td style="width:50mm; text-align:right;" >{{ $issued_items->created_by->name }}</td> --}}
            <td style="width:30mm; text-align:right;" >{{ date('Y-m-d H:i:s', strtotime($issued_items->created_at)) }}</td>
        </tr>
    </table>
    <table>
{{-- <tr>
<th style="text-align: left; width:2.8cm;"> Sales Executive:</th>
<td style= "text-align:left; width:10cm; ">{{ $issued_items->invoice->SalesStaff->employee_fullname }} | {{ $delivery_order->invoice->SalesStaff->employee_reg_no }}</td>
<th style="text-align: left;"> Inv.Ref.No:</th>
<td style= "text-align:left; width:10cm;">{{ $delivery_order->invoice->ref_number}}</td>
</tr> --}}
</table>
</body>

