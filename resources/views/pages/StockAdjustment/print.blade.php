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
            font-size: 14px;
        }

        th {
            text-align: left;
        }

        td,
        th {
             /* border: 1px solid black;  */
        }
    </style>
    <title>{{ $stock_adjustment_list->stock_adjustment_number }}</title>
</head>

<body>

    {{-- <table style="height: 21mm;">
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table> --}}
    <p style="text-align: center; text-decoration:underline; font-size:15px;"><b>STOCK ADJUSTMENT NO - {{ $stock_adjustment_list->stock_adjustment_number }}</b></p>
    <hr>
    <table>
        <tr>
            <td style="height:3mm;width: 5mm;"><b>Date:</b></td>
            <td style="height:3mm;width: 20mm;">{{ date('Y-m-d', strtotime($stock_adjustment_list->created_at)) }}</td>
            <td style="height:3mm; width: 10mm;"><b>Location:</b></td>
            @foreach ($stock_adjustment_list->items as $item )
            @endforeach
            <td style="height:3mm;width: 20mm;">{{ $item->fromWarehouse->warehouse_name }}</td>
            <td style="height:3mm; width: 10mm;"><b>Type:</b></td>
            <td style="height:3mm; width: 20mm;">{{ $stock_adjustment_list->type }}</td>
            <td style="height:3mm; width: 30mm;"><b>Approved Status: </b></td>
            <td style="height:3mm; width: 20mm;">{{ $stock_adjustment_list->approved_status }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="height:9mm;width: 10mm;"><b>Justificaion:</b></td>
            <td style="height:9mm;width: 20mm;">{{ $item->justification}}</td>
        </tr>
    </table>
<hr>
    <table style="height:70mm;">
        <tr>
            <th style="width: 2mm;">No.</th>
            <th style="width: 5mm; text-align:center;">From </th>
            {{-- <th style="width: 70mm;text-align:right;"></th> --}}
            <th style="width: 2mm;text-align:center;">To </th>
            {{-- <th style="width: 50mm;text-align:right;"></th> --}}
            <th style="width: 15mm;text-align:center;">U/M</th>
            <th style="width: 15mm;text-align:right;">Quantity</th>
        </tr>
        @foreach ($stock_adjustment_list->items as $key => $item)
            <tr>
                <td style="width:2mm;">{{ $key + 1 }}</td>
                {{-- <td style="width: 5mm;text-align:right;">{{ optional($item->from_stock_item)->stock_number }}</td> --}}
                <td style="width: 70mm;text-align:right;">{{ optional($item->from_stock_item)->description }}</td>
                {{-- <td style="width: 2mm;text-align:right;">{{ optional($item->to_stock_item)->stock_number }}</td> --}}
                <td style="width: 70mm;text-align:right;">{{ optional($item->to_stock_item)->description }}</td>
                <td style="width: 15mm;text-align:center;">{{ optional($item->from_stock_item)->unit }}</td>
                <td style="width: 15mm;text-align:right;">{{ $item->qty}}</td>

            </tr>
        @endforeach
    </table>
    <hr>
    <table>
        {{-- <tr>
            <th style="width: 25mm; text-align:left;">Created By</th>
            <th style="width: 25mm; text-align:left;">Created On</th>
            <th style="width: 25mm; text-align:left;">Approved By</th>
            <th style="width: 25mm; text-align:left;">Approved on</th>
        </tr> --}}

        <tr>
            <td style="width: 25mm; text-align:left;"><b>Created By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ $stock_adjustment_list->createdBy->employee_fullname }}</td>
            <td style="width: 25mm; text-align:left;"><b>Created On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $stock_adjustment_list->createdBy->created_at }}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Approved By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($stock_adjustment_list->approvedBy)->employee_fullname }}</td>
            <td style="width: 25mm; text-align:left;"><b>Approved on:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $stock_adjustment_list->approved_at }}</td>
        </tr>
    </table>
</body>
