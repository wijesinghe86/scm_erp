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
    <title>{{ $grn_list->grn_no }}</title>
</head>

<body>


    <p style="text-align: center; text-decoration:underline; font-size:15px;"><b>GOODS RECEIVED NO - {{ $grn_list->grn_no}}</b></p>
    <hr>
    <table>
        <tr>
            <td style="height:3mm;width: 25mm;text-align:left;"><b>Created Date:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ date('Y-m-d', strtotime($grn_list->created_at)) }}</td>
            <td style="height:3mm; width: 20mm;text-align:right;"><b>PO No:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ (optional($grn_list->poDetails)->po_no) }}</td>
            <td style="height:3mm; width: 20mm;text-align:right;"><b>PO Type:</b></td>
            <td style="height:3mm; width: 20mm;text-align:left;">{{ $grn_list->type }}</td>
            {{-- <td style="height:3mm; width: 30mm;text-align:right;"><b>Est.Value: </b></td>
            <td style="height:3mm; width: 10mm;text-align:left;">{{ $mr_list->total_value }}</td> --}}
        </tr>
    </table>
    <table>
        <tr>
            <td style="height:3mm;width: 15mm;text-align:left;"><b>Supplier:</b></td>
            <td style="height:3mm;width: 40mm;text-align:left;">{{ optional($grn_list->supplierDetails)->supplier_name}}</td>
        </tr>

    </table>
<hr>
     <table style="height:68mm;">
        <tr>
            <th style="width: 7mm;">No.</th>
            <th style="width: 20mm; text-align:left;">Stock No</th>
            <th style="width: 90mm;text-align:left;">Description </th>
            <th style="width: 20mm;text-align:left;">U/M</th>
            {{-- <th style="width: 20mm;text-align:left;">Order Qty</th> --}}
            <th style="width:20mm;text-align:right;">Rec Qty</th>
        </tr>
        @foreach ($grn_list->grnItems as $key => $items)

            <tr>
                <td style="width:7mm;">{{ $key + 1 }}</td>
                <td style="width: 20mm;text-align:left;">{{ optional($items->item)->stock_number }}</td>
                <td style="width: 90mm;text-align:left;">{{ optional($items->item)->description }}</td>
                <td style="width: 20mm;text-align:left;">{{ optional($items->item)->unit }}</td>
                {{-- <td style="width: 20mm;text-align:Right;">{{ optional(optional($items->po_list)->items)->po_qty}}</td> --}}
                <td style="width: 20mm;text-align:Right;">{{ optional($items)->rec_qty}}</td>

            </tr>
        @endforeach
    </table>
    <hr>
    <table>

        <tr>
            <td style="width: 25mm; text-align:left;"><b>Created By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($grn_list->createUser)->name }}</td>
            <td style="width: 25mm; text-align:left;"><b>Created On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $grn_list->created_at }}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Received By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($grn_list->receivedBy)->employee_fullname }}</td>
            <td style="width: 25mm; text-align:left;"><b>Received On</b></td>
            <td style="width: 35mm; text-align:left;">{{ $grn_list->received_date}}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Inspected By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($grn_list->inspectedBy)->employee_fullname }}</td>
            <td style="width: 25mm; text-align:left;"><b>Inspected On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $grn_list->inspected_date }}</td>
        </tr>
    </table>
</body>
