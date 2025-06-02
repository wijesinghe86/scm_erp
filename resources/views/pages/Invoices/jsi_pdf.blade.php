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
            border-collapse: collapse;
            border: 1px solid black;
            margin: 0;
            padding: 0;
            font-size: 15px;
        }

        th {
            text-align: left;
        }

        td,
        th {
             border: 1px solid black;
        }
</style>

<body>

    <table style="height: 20mm">
    </table>

    <table style="height: 20mm">
        <tr>
            <td style="text-align:center; font-size:22px">{{ $invoices->getInvoiceTypeNameAttribute() }}</td>
        </tr>
    </table>

    <table style="height: 23mm">
        <tr>
            <td style="width: 151mm" colspan="3">
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->customer->customer_name }}</div>
                    {{ $invoices->customer->customer_address_line1 }}<br>
                    {{ $invoices->customer->customer_address_line2 }}<br>
                </div>
            </td>
            <td style="height: 8mm; width:50mm; text-align:right;" >
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->invoice_date }}</div>
                </div>
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->invoice_number }}</div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 50mm; height: 8mm;">
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->customer->customer_vat_number }}</div>
                </div>
            </td>
            <td style="width: 70mm; height: 8mm;">
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->po_number }}</div>
                </div>
            </td>
            <td style="width: 31mm;height: 8mm;">
                <div style="font-size: 16px; margin-left: 2mm;">
                    <div>{{ $invoices->payment_terms }} {{ $invoices->credit_days }}</div>
                </div>
            </td>
            <td style="width: 31mm;height: 8mm;">
                <div style="font-size: 16px; margin-left: 2mm; text-align:right">
                    <div>{{ $invoices->ref_number }}</div>
                </div>
            </td>
        </tr>
    </table>

    <table style="height:75mm;">
        <thead>
            <tr>
                <th style="width:10mm; opacity: 0;">No.</th>
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
                <td style="width:10mm; text-align:right;">{{ $key + 1 }}</td>
                <td style="width:110mm; text-align:left;">{{ $item->description }}</td>
                <td style="width:16mm; text-align:right;">{{ $item->uom }}</td>
                <td style="width:17mm; text-align:right;">{{ $item->quantity }}</td>
                <td style="width:20mm; text-align:right;">{{ $item->unit_price }}</td>
                <td style="width:32mm; text-align:right;">{{ $item->total }} </td>
            </tr>
            <!--
@endforeach -->
        </tbody>
    </table>
    <table style="height: 23mm;">
        <tr>
            <td style="width: 30mm">
                <div style="font-size: 16px; margin-left: 2mm;text-align:center;">
                    <div>{{ $invoices->createUser ? $invoices->createUser->name : 'User Error' }}</div>
                </div>
            </td>
            <td style="width: 30mm">
                <div style="font-size: 16px; margin-left: 2mm;text-align:center;">
                    <div>{{ $invoices->SalesStaff->employee_reg_no }}</div>
                </div>
            </td>
            <td style="width: 80mm">
                <div style="font-size: 16px; margin-left: 2mm; opacity: 0;">
                    <div>blank</div>
                </div>
            </td>
            <td style="width: 36mm">
                <div style="font-size: 16px; margin-right: 2mm; text-align:right;">
                    <div>Salescode1</div>
                </div>
            </td>
            <td style="width: 32mm">
                <div style="font-size: 16px; margin-right: 2mm; text-align:right;">
                    <div>Salescode2</div>
                </div>
            </td>
        </tr>
    </table>
    <table style="height: 23mm;">
        <tr>
            <td style="width: 60mm">
                <div style="font-size: 16px; margin-left: 2mm;text-align:center;">
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
            <td style="width: 36mm">
                <div style="font-size: 16px; margin-left: 2mm;text-align:right;">
                    <div>Salescode3</div>
                </div>
            </td>
            <td style="width: 32mm">
                <div style="font-size: 16px; margin-left: 2mm;text-align:right;">
                    <div>Salescode4</div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
