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
    <title>{{ $po_list->po_no }}</title>
</head>

<body>



    <p style="text-align: center; text-decoration:underline; font-size:15px;"><b>PURCHASE ORDER NO - {{ $po_list->po_no}}</b></p>
    <hr>
    <table>
        <tr>
            <td style="height:3mm;width: 25mm;text-align:left;"><b>Created Date:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ date('Y-m-d', strtotime($po_list->po_date)) }}</td>
            <td style="height:3mm; width: 20mm;text-align:right;"><b>PO Type:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ $po_list->po_type }}</td>
            <td style="height:3mm; width: 20mm;text-align:right;"><b>PRF No:</b></td>
            <td style="height:3mm; width: 20mm;text-align:left;">{{ $po_list->purchase_request_id->mrfprf_no }}</td>
            {{-- <td style="height:3mm; width: 25mm;text-align:left;"><b>Approval Status:</b></td>
            <td style="height:3mm; width: 18mm;text-align:left;">{{ optional($po_list->items)->approval_status }}</td> --}}
            {{-- <td style="height:3mm; width: 30mm;text-align:right;"><b>Est.Value: </b></td>
            <td style="height:3mm; width: 10mm;text-align:left;">{{ $mr_list->total_value }}</td> --}}
        </tr>
    </table>
    <table>
        <tr>
            <td style="height:3mm;width: 15mm;text-align:left;"><b>Supplier:</b></td>
            <td style="height:3mm;width: 40mm;text-align:left;">{{ $po_list->get_supplier->supplier_name}}</td>
        </tr>

    </table>
<hr>
     <table style="height:70mm;">
        <tr>
            <th style="width: 7mm;">No.</th>
            <th style="width: 20mm; text-align:left;">Stock No</th>
            <th style="width: 90mm;text-align:left;">Description </th>
            <th style="width: 20mm;text-align:left;">U/M</th>
            <th style="width:20mm;text-align:right;">Order Qty</th>
        </tr>
        @foreach ($po_list->items as $key => $po_item)
            <tr>
                <td style="width:7mm;">{{ $key + 1 }}</td>
                <td style="width: 20mm;text-align:left;">{{ $po_item->item->stock_number }}</td>
                <td style="width: 90mm;text-align:left;">{{ $po_item->item->description }}</td>
                <td style="width: 20mm;text-align:left;">{{ $po_item->item->unit }}</td>
                <td style="width: 20mm;text-align:Right;">{{ $po_item->po_qty}}</td>

            </tr>
        @endforeach
    </table>
    <hr>
    <table>

        <tr>
            <td style="width: 25mm; text-align:left;"><b>Created By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($po_list->createUser)->name }}</td>
            <td style="width: 25mm; text-align:left;"><b>Created On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $po_list->created_at }}</td>
        </tr>
        <tr>
            <td style="width: 25mm; text-align:left;"><b>Approved By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($po_item->approvedBy)->name }}</td>
            <td style="width: 28mm; text-align:left;"><b>Approved Date:</b></td>
            <td style="width: 25mm; text-align:left;">{{ $po_item->approval_status_changed_at }}</td>

            {{-- <td style="width: 25mm; text-align:left;"><b>Requested on:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $mrs_list->requested_by }}</td> --}}
        </tr>
    </table>
</body>
