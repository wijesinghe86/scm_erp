<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        table {
            width: 100%;

            margin: 0.5mm;
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
    <title>{{ $creditnotes->credit_note_no }} | Credit Note</title>
</head>
<body>
  {{-- header --}}
  <p style="font-size: 30px; text-align:center">Credit Note</p>
  <hr>
   <table>
    <tr style="font-size: 20px">
       <td><strong>Customer:</strong></td> 
        <td><strong>Credit Note No: </strong>{{ $creditnotes->credit_note_no }}</td>
        <td><strong>Credit Note Date:</strong> {{ $creditnotes->credit_note_date}}</td></td>
        
        
        
    </tr>
    <tr style="font-size: 20px">
        <td>{{ $creditnotes->invoice->Customer->customer_name }}|{{ $creditnotes->invoice->Customer->customer_address_line1 }},{{ $creditnotes->invoice->Customer->customer_address_line2 }}</td><br>
        <td><strong>Invoice No: </strong>{{ $creditnotes->invoice->invoice_number}}</td>
        <td><strong>Invoice Date:</strong> {{ $creditnotes->invoice->invoice_date}}</td>
    </tr>
    <br>
    <tr style="font-size: 20px">
    <td><strong>Vat No:</strong> {{ $creditnotes->invoice->Customer->customer_vat_number }}</td> 
    <td><strong>Ref.Doc.No:</strong> {{ $creditnotes->getSource()->sourceNo }}</td>
    <td><strong>Hand Chit No:</strong> {{ $creditnotes->hand_chit_no}}</td>
    <td><strong>Less Invoice No: </strong>{{ $creditnotes->less_invoice_no }}</td>
</tr>
   </table>
   <hr>
   <br>
   <br>

    <table>
        <thead>
         <tr style="font-size: 20px">
            <th style="width:6mm;font-size: 20px">No.</th>
            <th style="width:86mm;font-size: 20px">Description</th>
            <th style="width:14mm;font-size: 20px">U/M</th>
            <th style="width:16mm;font-size: 20px">Credit Qty</th>
            <th style="width:20mm;font-size: 20px">Unit Rate</th>
            <th style="width:22.5mm;font-size: 20px">Sales Value(Rs.)</th>
            <th style="width:22.5mm;font-size: 20px">Vat Amount(Rs.)</th>
            <th style="width:32mm;">Total Sales Amount(Rs)</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($creditnotes->items as $key => $item)
                <tr style="font-size: 20px">
                    <td style="width:6mm; text-align:left;">{{ $key + 1 }}</td>
                    <td style="width:86mm; text-align:left;">{{ $item->stockItems->description }}</td>
                    <td style="width:14mm; text-align:left;">{{ $item->stockItems->unit }}</td>
                    <td style="width:16mm; text-align:left;">{{ $item->credit_qty }}</td>
                    <td style="width:20mm; text-align:left;">{{ $item->unit_rate}}</td>
                    <td style="width:22.5mm; text-align:left;">{{ $item->sales_value}}</td>
                    <td style="width:22.5mm; text-align:left;">{{ $item->vat_amount}}</td>
                    <td style="width:30mm; text-align:left;">{{ $item->total_sales_value}}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
    <table>
                <tr>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-size: 20px"><strong>Grand Total</strong></td>
                    <td style="width:68mm; align:left; font-size: 20px"><strong>{{ $item->credinotes->grand_total}}</td>
</strong>
            </tbody>
        </table>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('credit_note_print.print', ['creditnote_id' => $creditnotes->id]) }}"
            class="btn btn-success float-end mb-2" style="border: solid">
            Print </a>
    </div>
    {{-- <div style="display: flex;justify-content: flex-end; align-items: center; margin: 20px 0">
        <a target="_blank" href="{{ route('credit_note_print.print', ['creditnote_id' => $creditnotes->id]) }}"
            class="btn btn-success mb-5 float-end mb-5">Print</a>
</div> --}}
