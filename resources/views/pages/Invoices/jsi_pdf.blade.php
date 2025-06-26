@if ($invoices->status != null)
    <div style="display: flex; justify-content: flex-end; color:red;"> <span
            style="font-size:16px;text-transform: uppercase" class="badge badge-primary float-right">Duplicate
            Print</span></div>
@endif
<!DOCTYPE html>
<html>
<style>
    table {
            width: 100%;
            /* border-collapse: collapse;
            border: 1px solid black; */
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

<body>

    <table style="height: 15mm">
    </table>

    <table style="height: 20mm">
        <tr>
            <td style="text-align:center; font-size:22px">{{ $invoices->getInvoiceTypeNameAttribute() }}</td>
        </tr>
    </table>

    <table style="height: 23mm">
        <tr>
            <td style="width: 176mm" colspan="3">
                <div style="font-size: 16px; margin-left: 5mm;">
                    <div>{{ $invoices->customer->customer_name }}</div>
                    {{ $invoices->customer->customer_address_line1 }}<br>
                    {{ $invoices->customer->customer_address_line2 }}<br>
                </div>
            </td>
            <td style="width:42mm; text-align:right;" >
                <div style="font-size: 14px; margin-right: 2mm; height: 8mm;">
                    <div>{{ $invoices->invoice_date }}</div>
                </div>
                <div style="font-size: 14px; margin-right: 2mm; height: 8mm;">
                    <div>{{ $invoices->invoice_number }}</div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 50mm; height: 3mm;">
                <div style="font-size: 16px; margin-left: 5mm;">
                    <div>{{ $invoices->customer->customer_vat_number }}</div>
                </div>
            </td>
            <td style="width: 70mm; height: 3mm;">
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->po_number }}</div>
                </div>
            </td>
            <td style="width: 31mm;height: 3mm;">
                <div style="font-size: 13px; margin-left: 8mm;">
                    <div>{{ $invoices->payment_terms }} {{ $invoices->credit_days }}</div>
                </div>
            </td>
            <td style="width: 25mm;height: 3mm;">
                <div style="font-size: 14px; margin-left: 24mm; text-align:left">
                    <div></div>
                </div>
            </td>
        </tr>
    </table>

    <table style="height:80mm;">
        <thead>
            <tr>
                <th style="width:0mm; opacity: 0;">No.</th>
                <th style="width:110mm; opacity: 0;">Description</th>
                <th style="width:16mm; opacity: 0;">U/M</th>
                <th style="width:17mm; opacity: 0;">Ord, Qty.</th>
                <th style="width:20mm; opacity: 0;">Unit Rate(Rs.)</th>
                <th style="width:32mm; opacity: 0;">Amount(Rs)</th>
            </tr>

        </thead>
        <tbody>
            <!-- @foreach ($invoices->items as $key => $item)
-->
            <tr>
                <td style="width:0mm; text-align:left;">{{ $key + 1 }}</td>
                <td style="width:110mm; text-align:left;">{{ $item->description }}</td>
                <td style="width:16mm; text-align:left;">{{ $item->uom }}</td>
                <td style="width:17mm; text-align:left;">{{ $item->quantity }}</td>
                <td style="width:20mm; text-align:left;">{{ $item->unit_price }}</td>
                <td style="width:32mm; text-align:left;">{{ $item->total }} </td>
            </tr>
            <!--
@endforeach -->
        </tbody>
    </table>
    <table>
        <tr>
          <td style="width:135mm; height: 60mm" >
            <table style="height: 20mm;">
        <tr>
            <td style="width: 30mm">
                <div style="font-size: 14px; margin-left: 2mm;text-align:left; height: 0mm;">
                    <div>{{ $invoices->createUser ? $invoices->createUser->name : 'User Error' }}</div>
                </div>
            </td>
            <td style="width: 30mm">
                <div style="font-size: 13px; margin-left: 2mm;text-align:left; height: 0mm;">
                    <div>{{ $invoices->SalesStaff->employee_reg_no }}</div>
                </div>
            </td>
            <td style="width: 80mm">
                <div style="font-size: 16px; margin-left: 2mm; opacity: 0;">
                    <div>blank</div>
                </div>
            </td>
            </tr>
    </table>
              <table style="height: 10mm;">
        <tr>
            <td style="width: 60mm">
                <div style="font-size: 16px; margin-left: 2mm;text-align:left; height: 7mm;">
                    <div>{{ $invoices->created_at }}</div>
                </div>
            </td>
            <td style="width: 40mm">
                <div style="font-size: 16px; margin-left: 2mm; opacity: 0;text-align:center;">
                    <div>checked by</div>
                </div>
            </td>
            <td style="width: 38mm">
                <div style="font-size: 16px; margin-left: 2mm; opacity: 0; text-align:center;">
                    <div>Approved by</div>
                </div>
            </td>
            </tr>
    </table>
            </td>
            <td style="height:10mm;width:30mm">
                <div style="height:6px">Total(Rs.)</div></br>
                @if ($invoices->type != 1 && in_array($invoices->option, [1, 2]))
                    <div style="height:6px">Ex. Of Vat(Rs.)</div></br>
                @endif
                @if ($invoices->type != 1)
                    <div style="height:6px">Vat {{ $invoices->vat_rate }}</div></br>
                @endif
                @if ($invoices->discount_amount > 0)
                    <div style="height:6px">Dicount(Rs.)</div></br>
                @endif
                <div style="height:6px">Grand Total(Rs.)</div></br>
            </td>
            <td style="height:10mm;width:35mm; text-align:left;">
                <div style="height:6px">
                    {{ $invoices->type == 1 ? money($invoices->grand_total) : money($invoices->sub_total) }}</div></br>
                @if ($invoices->type != 1 && $invoices->option == 1)
                    <div style="height:6px">{{ money($invoices->sub_total) }}</div></br>
                @endif
                @if ($invoices->type != 1 && $invoices->option == 2)
                    <div style="height:6px">{{ money($invoices->sub_total - $invoices->vat_amount) }}</div></br>
                @endif
                @if ($invoices->type != 1)
                    <div style="height:6px">{{ $invoices->vat_amount }}</div></br>
                @endif
                @if ($invoices->discount_amount > 0)
                    <div style="height:6px">{{ money($invoices->discount_amount) }}</div></br>
                @endif
                <div style="height:6px">{{ money($invoices->grand_total) }}</div></br>
            </td>
        </tr>
    </table>
</body>

</html>
