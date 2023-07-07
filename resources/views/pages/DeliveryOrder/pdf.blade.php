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
            font-size: 14px;
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
    <table style="height: 6mm;">
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="4">
                <div style="margin-left: 20px">
                    {{ optional(optional(optional($delivery_order)->invoice)->customer)->customer_name }}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div style="margin-left: 20px">{{ $delivery_order->invoice->invoice_date }}</div>
            </td>
            <td>
                <div style="margin-left: 20px">{{ $delivery_order->invoice->invoice_number }}</div>
            </td>
            <td>
                <div style="margin-left: 20px">{{ $delivery_order->delivery_order_no }}</div>
            </td>
            <td>
                <div style="margin-left: 20px">{{ $delivery_order->location->warehouse_name }}</div>
            </td>
        </tr>
    </table>
    <table style="height: 8mm">
        <tr></tr>
    </table>
    <table style="height:105mm">
        @foreach ($delivery_order->items as $item)
            <tr>
                <td style="width:9mm"></td>
                <td style="width:18mm">{{ $item->stock_no }}</td>
                <td style="width:96mm">{{ $item->description }}</td>
                <td style="width:15mm">{{ $item->uom }}</td>
                <td style="width:20mm">{{ $item->qty }}</td>
                <td style="width:22mm">{{ $item->issued_qty }}</td>
                <td style="width:21mm">{{ $item->available_qty }}</td>
            </tr>
        @endforeach
    </table>
    <table style="height: 6mm">
        <tr>
            <td>
                <div style="margin-left: 33mm">{{ $delivery_order->invoice->invoice_date }}</div>
            </td>

            <td>
                <div style="margin-left: 33mm">{{ $delivery_order->invoice->invoice_date }}</div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width:100%"></td>
            <td style="width:100px" >{{ $delivery_order->createdBy->name }}</td>
            <td style="width:100px" >{{ date('Y-m-d H:s', strtotime($delivery_order->created_at)) }}</td>
        </tr>
    </table>
</body>
