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
    <title>{{ $slc_list->slc_number }}</title>
</head>

<body>



    <p style="text-align: center; text-decoration:underline; font-size:15px;"><b>STOCK LOCATION CHANGE NO - {{ $slc_list->slc_number}}</b></p>
    <hr>
    <table>
        <tr>
            <td style="height:3mm;width: 15mm;text-align:left;"><b>Created Date:</b></td>
            <td style="height:3mm;width: 30m;text-align:left;">{{ date('Y-m-d', strtotime($slc_list->slc_date)) }}</td>
            <td style="height:3mm; width: 10mm;text-align:right;"><b>From Loc:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ $slc_list->from_warehouse->warehouse_name}}</td>
            <td style="height:3mm; width: 10mm;text-align:right;"><b>To Loc:</b></td>
            <td style="height:3mm; width: 20mm;text-align:left;">{{ $slc_list->to_warehouse->warehouse_name }}</td>
            <td style="height:3mm; width: 30mm;text-align:left;"><b>Approval Status:</b></td>
            <td style="height:3mm; width: 18mm;text-align:left;">{{ $slc_list->approval_status }}</td>
        </tr>
        <tr>
            <td style="height:3mm; width: 15mm;text-align:left;"><b>Vehicle No: </b></td>
            <td style="height:3mm; width: 30mm;text-align:left;">{{ $slc_list->fleet->fleet_registration_number }}</td>
            <td style="height:3mm; width: 30mm;text-align:left;"><b>Driver Name: </b></td>
            <td style="height:3mm; width: 10mm;text-align:left;">{{ $slc_list->delivered_by }}</td>
            <td style="height:3mm; width: 30mm;text-align:left;"><b>Delivered Date: </b></td>
            <td style="height:3mm; width: 10mm;text-align:left;">{{ optional($slc_list)->delivered_date}}</td>
        </tr>
    </table>
    {{-- <table>
        <tr>
            <td style="height:3mm;width: 15mm;text-align:left;"><b>Supplier:</b></td>
            <td style="height:3mm;width: 40mm;text-align:left;">{{ $po_list->get_supplier->supplier_name}}</td>
        </tr>

    </table> --}}
<hr>
     <table style="height:50mm;">
        <tr>
            <th style="width: 7mm;">No.</th>
            <th style="width: 20mm; text-align:left;">Stock No</th>
            <th style="width: 90mm;text-align:left;">Description </th>
            <th style="width: 20mm;text-align:left;">U/M</th>
            <th style="width:20mm;text-align:right;">Order Qty</th>
        </tr>
        @foreach ($slc_list->items as $key => $slc_item)
            <tr>
                <td style="width:7mm;">{{ $key + 1 }}</td>
                <td style="width: 20mm;text-align:left;">{{ $slc_item->stock_item->stock_number }}</td>
                <td style="width: 90mm;text-align:left;">{{ $slc_item->stock_item->description }}</td>
                <td style="width: 20mm;text-align:left;">{{ $slc_item->stock_item->unit }}</td>
                <td style="width: 20mm;text-align:Right;">{{ $slc_item->qty}}</td>

            </tr>
        @endforeach
    </table>
    <hr>
    <table>

        <tr>
            <td style="width: 25mm; text-align:left;"><b>Issued By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($slc_list->issuedBy)->employee_fullname }}</td>
            <td style="width: 25mm; text-align:left;"><b>Issued On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $slc_list->issued_date }}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Approved By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($slc_list->approvedBy)->name }}</td>
            <td style="width: 28mm; text-align:left;"><b>Approved Date:</b></td>
            <td style="width: 25mm; text-align:left;">{{ $slc_list->approved_date }}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Received By:</b></td>
            <td style="width: 35mm; text-align:left;">{{ optional($slc_list->receivedBy)->employee_fullname }}</td>
            <td style="width: 25mm; text-align:left;"><b>Received On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $slc_list->received_date }}</td>
        </tr>
    </table>
</body>
