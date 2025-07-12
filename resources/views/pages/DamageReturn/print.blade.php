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
    <title>{{ $dr_list->dr_no }}</title>
</head>

<body>


    <p style="text-align: center; text-decoration:underline; font-size:15px;"><b>DAMAGE RETURN NO - {{ $dr_list->dr_no}}</b></p>
    <hr>
    <table>
        <tr>
            <td style="height:3mm;width: 25mm;text-align:left;"><b>Created Date:</b></td>
            <td style="height:3mm;width: 25mm;text-align:left;">{{ date('Y-m-d', strtotime($dr_list->date)) }}</td>
            <td style="height:3mm; width: 30mm;text-align:right;"><b>Reference No:</b></td>
            <td style="height:3mm;width: 20mm;text-align:left;">{{ (optional($dr_list->delivery_no)->delivery_order_no) }}</td>
            <td style="height:3mm; width: 20mm;text-align:right;"><b>Location:</b></td>
            <td style="height:3mm; width: 25mm;text-align:left;">{{ ($dr_list->location->warehouse_name) }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td style="height:3mm;width: 30mm;text-align:left;"><b>Reason for Damage:</b></td>
            <td style="height:3mm;width: 60mm;text-align:left;">{{ $dr_list->reason}}</td>
        </tr>

    </table>
<hr>
     <table style="height:70mm;">
        <tr>
            {{-- <th style="width: 7mm;">No.</th> --}}
            <th></th>
            <th style="width: 25mm; text-align:left;">Original Item</th>
            <th></th>
            <th style="width: 25mm;text-align:left;">Damage Item</th>
            <th style="width: 10mm;text-align:left;">U/M</th>
            <th style="width:20mm;text-align:right;">Return Qty</th>
        </tr>

            <tr>
                {{-- <td style="width:7mm;">{{$loop->iteration }}</td> --}}

                <td style="width: 5mm;text-align:left;">{{ optional($dr_list->ori_items)->stock_number }}</td>
                <td style="width: 50mm;text-align:left;">{{ optional($dr_list->ori_items)->description }}</td>
                <td style="width: 5mm;text-align:left;">{{ optional($dr_list->dmg_items)->stock_number }}</td>
                <td style="width: 50mm;text-align:left;">{{ optional($dr_list->dmg_items)->description }}</td>
                <td style="width: 10mm;text-align:left;">{{ optional($dr_list->dmg_items)->unit }}</td>
                <td style="width: 10mm;text-align:Right;">{{$dr_list->qty}}</td>

            </tr>

    </table>
    <hr>
    <table>

        <tr>
            <td style="width: 25mm; text-align:left;"><b>Created By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($dr_list->createdBy)->name }}</td>
            <td style="width: 25mm; text-align:left;"><b>Created On:</b></td>
            <td style="width: 35mm; text-align:left;">{{ $dr_list->created_at }}</td>
        </tr>
        {{-- <tr>
            <td style="width: 25mm; text-align:left;"><b>Returned By:</b></td>
            <td style="width: 25mm; text-align:left;">{{ optional($mr_list->requested_by)->employee_fullname }}</td>
           </tr> --}}
    </table>
</body>
