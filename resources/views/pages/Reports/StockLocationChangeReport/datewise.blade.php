

<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        table {
            width: 100%;

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
    <title>Date-Wise Report</title>
</head>

<body>
    <h2> Location-wise SLC Status</h2>
  {{-- header --}}
    <hr>

    {{-- <table style="border-style:solid; height:109mm; border-width:2px "> --}}
    <table style="height:109mm;">
        <thead>
         <tr>
             <th style="width:6mm; ">No.</th>
             <th style="width:3mm; text-align:left;">SLC No</th>
            <th style="width:3mm; text-align:left;">From Location</th>
            <th style="width:8mm; text-align:left;">To Location</th>
            <th style="width:3mm; text-align:left;">Stock No</th>
            <th style="width:20mm; text-align:left;">Description</th>
            <th style="width:3mm; text-align:right;">Qty</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($slcLogs as $slc)
            <tr>
                 <td>{{$loop->iteration}}</td>
                <td style="width:3mm; text-align:left;">{{ $slc->slc_no->slc_number }}</td>
                <td style="width:8mm; text-align:left;">{{$slc->from_warehouse->warehouse_name }}</td>
                <td style="width:3mm; text-align:left;">{{ $slc->to_warehouse->warehouse_name }}</td>
                <td style="width:3mm; text-align:left;">{{ $slc->stock_item->stock_number}}</td>
                <td style="width:20mm; text-align:left;">{{ $slc->stock_item->description}}</td>
                <td style="width:3mm; text-align:right;">{{ $slc->qty}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
