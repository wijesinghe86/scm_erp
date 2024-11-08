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
    <title>Transaction History </title>
</head>

<body>
    <h2>Item-wise Transaction History Report </h2>
  {{-- header --}}
   <hr>

    {{-- <table style="border-style:solid; height:109mm; border-width:2px "> --}}
    <table>
        <tr>
            <th>Stock No</th>
            <th>Description</th>
            <th>U/M</th>
            <th>Location</th>
        </tr>
        <tr>

        <td>{{  $items->stock_number }}</td>
        <td>{{  $items->description }}</td>
        <td>{{  $items->unit }}</td>
        <td>{{  $warehouses->warehouse_name }}</td>
        </tr>

    </table>

    <br>
    <hr>

                    <table class="table table-striped">
                        <tr>
                            <th scope=" col" style="width:2mm; align="left" >#</th>
                            <th scope=" col" style="width:2mm; align="left" >Transaction Date</th>
                            <th scope="col" style="width:3mm; align="left" >Transaction Name</th>
                            <th scope="col" style="width:8mm; align="left">Transaction Type</th>
                            <th scope="col" style="width:8mm; align="left">Reference</th>
                            <th scope="col" style="width:8mm; align="left">Qty</th>
                            <th scope="col" style="width:3mm; align="left" >Balance</th>
                        </tr>
                        @foreach ($stockLogs as $stockLog)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td style="width:3mm; align="left">{{ $stockLog->transaction_date}}</td>
                                                            <td style="width:3mm; align="left">{{ $stockLog->event}}</td>
                                                            <td style="width:3mm; align="left">{{ $stockLog->transaction_type}}</td>
                                                            <td style="width:3mm; align="left">{{ $stockLog->reference}}</td>
                                                            <td style="width:3mm; align="center">{{ $stockLog->qty }}</td>
                                                            <td style="width:3mm; align="center">{{ $stockLog->stockInHand }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>

                                            </body>
