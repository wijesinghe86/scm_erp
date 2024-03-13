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
    <title>{{ $invoices->invoice_number }} | Sales Order</title>
</head>

<body>
  {{-- header --}}
<strong><p style="font-size:20px; text-align:center;"> Sales Order of {{ $invoices->invoice_number }}</p></strong>
   <br>
   <br>
   <div class="row">
    <div class="form-group col-md-4">
        <label>Invoice Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  :{{ $invoices->invoice_date }}</label>
    </div>
    <div class="form-group col-md-4">
        <label>Customer Name&nbsp;&nbsp; :{{ $invoices->customer->customer_name }}</label>
    </div>
    <div class="form-group col-md-4">
        <label>Sales Executive&nbsp;&nbsp;&nbsp; :{{ $invoices->SalesStaff->employee_fullname }} | {{ $invoices->SalesStaff->employee_reg_no }}</label>
    </div>

    <div class="form-group col-md-4">
        <label>Reference No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :{{ $invoices->ref_number  }}</label>
    </div>
    <br>
    <hr>
    
    {{-- <table style="border-style:solid; height:109mm; border-width:2px "> --}}
    <table style="height:109mm;">
        <thead>
         <tr>
            <th style="width:6mm; ">No.</th>
            <th style="width:86mm; ">Description</th>
            <th style="width:14mm; ">U/M</th>
            <th style="width:16mm; text-align:right;">Ord.Qty.</th>
            <th style="width:20mm; text-align:right;">Location</th>
            
        </tr>

        </thead>
        <tbody>
        @foreach ($invoices->items as $key => $item)
            <tr>
                <td style="width:6mm; text-align:left;">{{ $key + 1 }}</td>
                <td style="width:86mm; text-align:left;">{{ $item->description }}</td>
                <td style="width:14mm; text-align:left;">{{ $item->uom }}</td>
                <td style="width:16mm; text-align:right;">{{ $item->quantity }}</td>
                <td style="width:20mm; text-align:right;">{{ $item->location->warehouse_name}}</td>
                
            </tr>
        @endforeach
        </tbody>
    </table>
    