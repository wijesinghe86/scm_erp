

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
    <h2> MRS DATE-WISE REPORT </h2>
  {{-- header --}}
    <hr>

    {{-- <table style="border-style:solid; height:109mm; border-width:2px "> --}}
    <table style="height:109mm;">
        <thead>
         <tr>
             <th style="width:6mm; ">No.</th>
            <th style="width:3mm; text-align:left;">MRS No</th>
            <th style="width:8mm; text-align:left;">Customer</th>
            <th style="width:3mm; text-align:left;">Invoice No</th>
            <th style="width:3mm; text-align:left;">D_O No</th>
            <th style="width:3mm; text-align:left;">Location</th>
            <th style="width:20mm; text-align:center;">Items</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($mrsdata as $item)
            <tr>
                 <td>{{$loop->iteration}}</td>
                <td style="width:3mm; text-align:left;">{{ $item->return_no }}</td>
                <td style="width:8mm; text-align:left;">{{ $item->invoice->Customer->customer_name}}</td>
                <td style="width:3mm; text-align:left;">{{ $item->invoice->invoice_number }}</td>
                <td style="width:3mm; text-align:left;">{{ $item->deliveryOrder->delivery_order_no}}</td>
                <td style="width:3mm; text-align:left;">{{ $item->location->warehouse_name}}</td>
                {{-- <td style="width:8mm; text-align:right;">{{ json_encode($item->items->description)}}</td> --}}
                <td>
                    <table class="table table-striped">
                        <tr>
                            {{-- <th scope=" col" >#</th> --}}
                            <th scope="col" style="width:3mm; align="left" >S/No</th>
                            <th scope="col" style="width:8mm; align="left">Descrition</th>
                            <th scope="col" style="width:3mm; align="left" >Qty</th>
                        </tr>
                        @foreach ($item->items as $returned_item)
                                                        <tr>
                                                            {{-- <td>{{$loop->iteration}}</td> --}}
                                                            <td style="width:3mm; align="left">{{ $returned_item->stock_no }}</td>
                                                            <td style="width:8mm; align="left">{{ $returned_item->description }}</td>
                                                            <td style="width:3mm; align="center">{{ $returned_item->quantity }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>


            </tr>
        @endforeach
        </tbody>
    </table>
