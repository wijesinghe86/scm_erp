
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
            font-size: 18px;

        }

        th {
            text-align: left;
        }

        td,
        th {
             /* border: 1px solid black; */
        }
    </style>
    <title> Location On Hand Balance</title>
 
</head>

<body>
    
    @foreach ($stocks as $stock)
  @endforeach
  <h2 style="text-align:center;"><u>{{$stock->warehouse->warehouse_name}} Location - Stock On Hand Balance Report As At  {{ date('l, F j, Y') }}</u></h2>
   
<br>
<br>

    {{-- <table style="border-style:solid; height:109mm; border-width:2px "> --}}
    <table style="height:109mm;">
        <thead>
         <tr style="border-collapse: collapse; border: 1px solid black;">
             <th style="width:0.5mm; text-align:left;border-collapse: collapse; border: 1px solid black; ">No.</th> 
             <th style="width:2mm; text-align:left; border-collapse: collapse; border: 1px solid black;">Stock No</th>
            <th style="width:15mm; text-align:left; border-collapse: collapse; border: 1px solid black;">Description</th>
            <th style="width:3mm; text-align:center; border-collapse: collapse; border: 1px solid black;">U/M</th>
            <th style="width:3mm; text-align:right; border-collapse: collapse; border: 1px solid black;">Qty</th>
           
        </tr>
  
        </thead>
        <tbody>
        @foreach ($stocks as $stock)
            <tr>
                 <td style="width:0.5mm; text-align:left; border-collapse: collapse; border: 1px solid black;">{{$loop->iteration}}</td>
                <td style="width:3mm; text-align:left; border-collapse: collapse; border: 1px solid black;">{{ optional($stock->item)->stock_number }}</td>
                <td style="width:15mm; text-align:left; border-collapse: collapse; border: 1px solid black;">{{optional($stock->item)->description }}</td>
                <td style="width:3mm; text-align:center; border-collapse: collapse; border: 1px solid black;">{{ optional($stock->item)->unit }}</td>
                <td style="width:3mm; text-align:right; border-collapse: collapse; border: 1px solid black;">{{ $stock->qty}}</td>
                

            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>


