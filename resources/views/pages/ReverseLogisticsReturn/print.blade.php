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
        
    </style>
    <title>{{ $rmrs_list->return_no }}</title>
</head>

<body>


    <p style="text-align: center; text-decoration:underline; font-size:15px;"><b>REVERSE RETURN NO - {{ $rmrs_list->return_no }}</b></p>
    <hr>
    <table>
        <tr>
            <td style="height:3mm;width: 5mm;text-align:left;"><b>Date:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ date('Y-m-d', strtotime($rmrs_list->created_at)) }}</td>
            <td style="height:3mm; width: 10mm;text-align:left;"><b>Location:</b></td>
            <td style="height:3mm;width: 10mm;text-align:left;">{{ $rmrs_list->location->warehouse_name }}</td>
            <td style="height:3mm; width: 20mm;text-align:left;"><b>Invoice No:</b></td>
            <td style="height:3mm; width: 20mm;text-align:left;">{{ $rmrs_list->get_invoice->invoice_number }}</td>
            <td style="height:3mm; width: 25mm;text-align:left;"><b>Invoice Date:</b></td>
            <td style="height:3mm; width: 18mm;text-align:left;">{{ $rmrs_list->get_invoice->invoice_date }}</td>
            <td style="height:3mm; width: 15mm;text-align:left;"><b>D/O No: </b></td>
            <td style="height:3mm; width: 10mm;text-align:left;">{{ $rmrs_list->deliveryOrder->delivery_order_no }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="height:9mm;width: 10mm;"><b>Customer Name:</b></td>
            <td style="height:9mm;width: 30mm;">{{ $rmrs_list->get_invoice->Customer->customer_name}}</td>
        </tr>

        {{-- <tr>
            <td style="height:9mm;width: 10mm;"><b>Reason for Return:</b></td>
            <td style="height:9mm;width: 20mm;">{{ $rmrs_list->return_reason}}</td>
        </tr> --}}
    </table>
<hr>
     <table style="height:70mm;">
        <tr>
            <th style="width: 7mm;">No.</th>
            <th style="width: 20mm; text-align:left;">Stock No</th>
            <th style="width: 90mm;text-align:left;">Description </th>
            <th style="width: 20mm;text-align:left;">U/M</th>
            <th style="width:20mm;text-align:right;">Rec Qty</th>
        </tr>
        @foreach ($rmrs_list->items as $key => $item)
            <tr>
                <td style="width:7mm;">{{ $key + 1 }}</td>
                <td style="width: 20mm;text-align:left;">{{ $item->stock_no }}</td>
                <td style="width: 90mm;text-align:left;">{{ $item->description }}</td>
                <td style="width: 20mm;text-align:left;">{{ $item->uom }}</td>
                <td style="width: 20mm;text-align:center;">{{ $item->quantity}}</td>

            </tr>
        @endforeach
    </table>
    <hr>
    <table>

        <tr>
            <td style="width: 25mm; text-align:left;"><b>Created By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($rmrs_list->createdBy)->name }}</td>
            <td style="width: 25mm; text-align:left;"><b>Created On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $rmrs_list->created_at }}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Approved By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($rmrs_list->approvedBy)->name }}</td>
            <td style="width: 25mm; text-align:left;"><b>Approved on:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $rmrs_list->approved_at }}</td>
        </tr>
    </table>
</body>
