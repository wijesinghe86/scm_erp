<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        *{
            margin-top: 2mm;

        }

        table {
            width: 100%;

            margin: 0;
            padding: 0;
            font-size: 13px;

        }

        th {
            text-align: left;
        }

        td,
        th {
             /* border: 1px solid black; */
        }
    </style>
    {{-- <title>{{ $creditnotes->credit_note_no }} | Credit Note</title> --}}
</head>
<body>
  {{-- header --}}
  <h2 style="text-align:center;">Janatha Steel Tube (Private) Limited</h2>
  <h4 style="text-align:center; margin-top:-5mm;">Pallegodawatta Industrial Village, Meegama Road, Mathugama</h4>
  <h4 style="text-align:center; margin-top:-5mm;">Vat Reg.No:174022291-7000</h4>
  <hr>
  <p style="font-size: 25px; text-align:center">Purchase Order</p>
  <hr>

   {{-- <table>
    <tr style="font-size: 13px">
       <td style="text-align: left; width:40mm"><strong>Customer:</strong></td>
       <td></td>
       <td></td>
       <td></td>
        <td style="text-align: left; width:50mm"><strong>Credit Note No:</strong>{{ $creditnotes->credit_note_no }}</td>




    </tr>
    <tr style="font-size: 13px">
        <td style="width:30mm">{{ $creditnotes->invoice->Customer->customer_code }} | {{ $creditnotes->invoice->Customer->customer_name }}|{{ $creditnotes->invoice->Customer->customer_address_line1 }},{{ $creditnotes->invoice->Customer->customer_address_line2 }}</td><br>
        <td style="width:45mm; text-align: left "><strong>Credit Note Date:</strong> {{ $creditnotes->credit_note_date}}</td></td>
        <td style="width:35mm"><strong>Invoice No: </strong>{{ $creditnotes->invoice->invoice_number}}</td>
        <td style="width:30mm"><strong>Invoice Date:</strong> {{ $creditnotes->invoice->invoice_date}}</td>
    </tr>
    <br>
    <tr style="font-size: 13px;">
    <td><strong>Vat No:</strong> {{ $creditnotes->invoice->Customer->customer_vat_number }}</td>
    <td><strong>Ref.Doc.No:</strong> {{ $creditnotes->getSource()->sourceNo }}</td>
    <td><strong>Hand Chit No:</strong> {{ $creditnotes->hand_chit_no}}</td>
    <td><strong>Less Invoice No: </strong>{{ $creditnotes->less_invoice_no }}</td>
</tr>
   </table>
   <hr>
   <br>
   <br>

    <table style="border-bottom:solid font-size:13px; margin-top:-5mm; ">
        <thead >
         <tr style="border-style:solid">
            <th style="border-style: solid width:6mm;">No.</th>
            <th style="border-style: solid width:60mm;">Description</th>
            <th style="border-style: solid width:16mm;">U/M</th>
            <th style="border-style: solid width:16mm;text-align:right;">Credit Qty</th>
            <th style="border-style: solid width:20mm;text-align:right;">Unit Rate</th>
            <th style="border-style: solid width:20mm;text-align:right;">Sales Value(Rs.)</th>
            <th style="border-style: solid width:22mm;text-align:right;">Vat Amt(Rs.)</th>
            <th style="border-style: solid width:32mm;text-align:right;">Tot.Sales Amount(Rs)</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($creditnotes->items as $key => $item)
                <tr style="border-style: solid">
                    <td style="border-style: solid width:6mm; text-align:left;">{{ $key + 1 }}</td>
                    <td style="border-style: solid width:60mm; text-align:left;">{{ $item->stockItems->description }}</td>
                    <td style="border-style: solid width:16mm; text-align:left;">{{ $item->stockItems->unit }}</td>
                    <td style="border-style: solid width:16mm; text-align:right;;">{{ $item->credit_qty }}</td>
                    <td style="border-style: solid width:20mm; text-align:right;">{{ $item->unit_rate}}</td>
                    <td style="border-style: solid width:20mm; text-align:right;">{{ $item->sales_value}}</td>
                    <td style="border-style: solid width:22mm; text-align:right;">{{ $item->vat_amount}}</td>
                    <td style="border-style: solid width:30mm; text-align:right;">{{ $item->total_sales_value}}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <table>
                <tr>
                    <td style="font-size: 13px"><strong>Grand Total</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="width:12mm; align:left; font-size: 13px"><strong>{{ $item->credinotes->grand_total}}</td>
                </tr>
<br>
<br>
                <tr>
                    <td><strong>Created By:</strong> {{ $item->credinotes->createUser->name }}</td>
                    <td style="text-align: left"><strong>Approved By:</strong>{{ $item->updateUser->name }}</td>


                </tr>
                <tr>
                    <td><strong>Created Date|Time:</strong>{{ $item->credinotes->created_at }}</td>
                        <td style="text-align: left"><strong>Approved Date|Time:</strong>{{ $item->status_updated_date_time }}</td> --}}
        {{-- </table> --}}


