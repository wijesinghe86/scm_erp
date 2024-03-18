<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        table {
            width: 103mm;
            /* border-collapse: collapse; */
            /* border: 1px solid black; */
            margin: 0;
            padding: 0;
            font-size: 13px;
        }

        th {
            text-align: left;
        }

        td,
        th {
             /* border: 1px solid black;  */
        }
    </style>
    <title>{{ $balance_order->balance_order_no }}</title>
</head>

<body>

    {{-- <table style="height: 21mm;">
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table> --}}
    <p style="text-align: left; text-decoration:underline">Balance Order</p>
    <table>
        <tr>
            <td style="height:9mm;width: 13mm;">Date:</td>
            <td style="height:9mm;width: 100%;">{{ date('Y-m-d', strtotime($balance_order->created_at)) }}</td>
            <td style="height:9mm;">Location:</td>
            <td style="height:9mm;width: 12mm;">{{ $balance_order->location->warehouse_name }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="width: 20mm;">
                Customer:
            </td>
            <td colspan="5">
                {{ $balance_order->invoice->customer->customer_name }}</br>
                {{-- {{ $balance_order->invoice->customer->customer_mobile_number }}</br>
                {{ $balance_order->invoice->customer->customer_email }}</br> --}}
            </td>
        </tr>
        <br>
        <tr>
            <td>
                Invoice No.
            </td>
            <td>{{ $balance_order->invoice_number }}</td>
            <td>DO No.</td>
            <td>{{ $balance_order->deliveryOrder->delivery_order_no }}</td>
            <td>BO No.</td>
            <td>{{ $balance_order->balance_order_no }}</td>
        </tr>
        <br>
        <br>
    </table>
    <table style="height: 83mm;">
        <tr>
            <th style="width: 7mm;">No.</th>
            <th style="width: 19mm;">Stock No</th>
            <th style="width: 60mm;">Description</th>
            <th style="width: 15mm;">U/M</th>
            <th style="width: 13mm;">Quantity</th>
        </tr>
        @foreach ($balance_order->items as $key => $item)
            <tr>
                <td style="width: 7mm;">{{ $key + 1 }}</td>
                <td style="width: 19mm;">{{ $item->stock_no }}</td>
                <td style="width: 60mm;">{{ $item->description }}</td>
                <td style="width: 15mm;">{{ $item->uom }}</td>
                <td style="width: 20mm;">{{ $item->qty }}</td>
            </tr>
        @endforeach
    </table>
    <table>
        <tr>
            <td>Created By:{{ $balance_order->createUser->name }}</td>
        </tr>
    </table>
</body>
