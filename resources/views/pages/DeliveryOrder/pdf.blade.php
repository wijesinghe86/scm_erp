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
    <title>{{ $delivery_order->delivery_order_no }}</title>
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
                    {{ optional(optional(optional($delivery_order)->invoice)->customer)->customer_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vehicle No:{{$delivery_order->vehicle_no}}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NIC No:{{$delivery_order->nic_no}}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="margin-left: 75px; text-align:left;">{{ $delivery_order->invoice->invoice_date }}</div>
            </td>
            <td>
                <div style="margin-left: 20px; text-align:left;">{{ $delivery_order->invoice->invoice_number }}</div>
            </td>
            <td>
                <div style="margin-left: 20px; text-align:right;">{{ $delivery_order->delivery_order_no }}</div>
            </td>
            <td>
                <div style="margin-left: 20px; text-align:right;">{{ $delivery_order->location->warehouse_name }}</div>
            </td>
        </tr>
        
    </table>
    <table style="height: 8mm">
        <tr></tr>
    </table>
    <table style="height:80mm">
        @foreach ($delivery_order->items as $item)
            <tr>
                <td style="width:4mm">{{$loop->iteration}}</td>
                <td style="width:13mm">{{ $item->stock_no }}</td>
                <td style="width:95mm">{{ $item->description }}</td>
                <td style="width:15mm">{{ $item->uom }}</td>
                <td style="width:25mm">{{ $item->qty }}</td>
                <td style="width:25mm">{{ $item->issued_qty }}</td>
                <td style="width:25mm">{{ $item->available_qty }}</td>
            </tr>
        @endforeach
    </table>
    <table style="height: 3mm">
        <tr>
            <td>
                {{-- <div style="margin-left: 33mm">{{ $delivery_order->invoice->invoice_date }}</div> --}}
            </td>

            <td>
                {{-- <div style="margin-left: 33mm">{{ $delivery_order->invoice->invoice_date }}</div> --}}
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width:100%"></td>
            <td style="width:50mm; text-align:right;" >{{ $item->issued->name }}</td>
            <td style="width:30mm; text-align:right;" >{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
        </tr>
    </table>
    <table>
<tr>
<th style="text-align: left; width:2.8cm;"> Sales Executive:</th>
<td style= "text-align:left; ">{{ $delivery_order->invoice->SalesStaff->employee_fullname }} | {{ $delivery_order->invoice->SalesStaff->employee_reg_no }}</td>
<th style="text-align: left;"> Inv.Ref.No:</th>
<td style= "text-align:left; width:10cm;">{{ $delivery_order->invoice->ref_number}}</td>
</tr>
</table>
</body>

