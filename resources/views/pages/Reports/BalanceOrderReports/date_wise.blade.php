

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
    <h2> Balance Orders Status  </h2>
  {{-- header --}}
    <hr>

    {{-- <table style="border-style:solid; height:109mm; border-width:2px "> --}}
    <table style="height:109mm;">
        <thead>
         <tr>
             <th style="width:6mm; ">No.</th>
            <th style="width:3mm; text-align:left;">Customer</th>
            <th style="width:8mm; text-align:left;">Invoice No</th>
            <th style="width:3mm; text-align:left;">D/o no</th>
            <th style="width:3mm; text-align:left;">B/O No</th>
            <th style="width:3mm; text-align:left;">Warehouse</th>
            <th style="width:20mm; text-align:center;">Items</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($bo_date as $item)
            <tr>
                 <td>{{$loop->iteration}}</td>
                <td style="width:3mm; text-align:left;">{{ $item->invoice->Customer->customer_name }}</td>
                <td style="width:8mm; text-align:left;">{{$item->invoice->invoice_number }}</td>
                <td style="width:3mm; text-align:left;">{{ $item->deliveryOrder->delivery_order_no }}</td>
                <td style="width:3mm; text-align:left;">{{ $item->balance_order_no}}</td>
                <td style="width:3mm; text-align:left;">{{ $item->location->warehouse_name}}</td>
                {{-- <td style="width:8mm; text-align:right;">{{ json_encode($item->items->description)}}</td> --}}
                <td>
                    <table class="table table-striped">
                        <tr>
                            {{-- <th scope=" col" >#</th> --}}
                            <th scope="col" style="width:3mm; align="left" >S/No</th>
                            <th scope="col" style="width:10mm; align="left">Descrition</th>
                            <th scope="col" style="width:10mm; align="left">U/M</th>
                            <th scope="col" style="width:5mm; align="left" >Qty</th>
                        </tr>
                        @foreach ($item->items as $balance_items)
                                                        <tr>
                                                            {{-- <td>{{$loop->iteration}}</td> --}}
                                                            <td style="width:3mm; align="left">{{ $balance_items->stock_no }}</td>
                                                            <td style="width:10mm; align="left">{{ $balance_items->description }}</td>
                                                            <td style="width:10mm; align="left">{{ $balance_items->uom }}</td>
                                                            <td style="width:5mm; align="right">{{ $balance_items->qty }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>


            </tr>
        @endforeach
        </tbody>
    </table>
