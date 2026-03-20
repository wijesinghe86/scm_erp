@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">

            <div class="invoice-box">

                <!-- HEADER -->
                <div class="header">
                    <div class="company">
                        <h2>{{ optional($invoices->organization)->organization_name }}</h2>
                        <p>
                            {{ optional($invoices->organization)->organization_address_line1 }}<br>
                            {{ optional($invoices->organization)->organization_address_line2 }}<br>
                            Tel: {{ optional($invoices->organization)->organization_phone_number }}
                        </p>
                    </div>

                    <div class="title">
                        <h1>TAX INVOICE</h1>
                    </div>
                </div>

                <!-- CUSTOMER + INVOICE INFO -->
                <div class="info-section">
                    <div class="left">
                        <strong>Invoice To:</strong><br>
                        {{ $invoices->customer->customer_name }}<br>
                        {{ $invoices->customer->customer_address_line1 }}<br>
                        VAT: {{ $invoices->customer->customer_vat_number }}
                    </div>

                    <div class="right">
                        <table>
                            <tr>
                                <td>Date</td>
                                <td>{{ $invoices->invoice_date }}</td>
                            </tr>
                            <tr>
                                <td>Invoice No</td>
                                <td>{{ $invoices->invoice_number }}</td>
                            </tr>
                            <tr>
                                <td>PO No</td>
                                <td>{{ $invoices->po_number }}</td>
                            </tr>
                            <tr>
                                <td>Terms</td>
                                <td>{{ $invoices->getPaymentTerm() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- ITEMS TABLE -->
                <table class="items">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>U/M</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices->items as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->uom }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ money($item->unit_price) }}</td>
                            <td>{{ money($item->item_discount_amount) }}</td>
                            <td>{{ money($item->total) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- TOTALS -->
                <div class="totals">
                    <table>
                        <tr>
                            <td>Sub Total</td>
                            <td>{{ money($invoices->sub_total) }}</td>
                        </tr>

                        @if ($invoices->type != 1)
                        <tr>
                            <td>VAT ({{ $invoices->vat_rate }})</td>
                            <td>{{ money($invoices->vat_amount) }}</td>
                        </tr>
                        @endif

                        @if ($invoices->discount_amount > 0)
                        <tr>
                            <td>Discount</td>
                            <td>
                                {{ $invoices->discount_type == 'percentage' 
                                    ? money($invoices->sub_total * ($invoices->discount_amount/100)) 
                                    : money($invoices->discount_amount) }}
                            </td>
                        </tr>
                        @endif

                        <tr class="grand">
                            <td>Grand Total</td>
                            <td>{{ money($invoices->grand_total) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- FOOTER -->
                <!-- <div class="footer">
                    <div>
                        <strong>Amount in Words:</strong><br>
                        {{ $invoices->grand_total_inword }}
                    </div> -->

                    <!-- <div class="sign">
                        ___________________________<br>
                        Authorized Signature
                    </div> -->
                </div>

            </div>

            <!-- ACTION BUTTONS -->
            <div style="display: flex;justify-content: flex-end; align-items: center; margin: 20px 0">
            <!-- <div style="margin-top:20px;"> -->
                <a target="_blank"
                   href="{{ route('distributor_invoices.print', ['invoice_id' => $invoices->id]) }}"
                   class="btn btn-secondary">Print</a>


                <a href="{{ route('distributor_invoices.create') }}"
                   class="btn btn-primary">Back</a>
            </div>

        </div>
    </div>
</div>

<style>
.invoice-box {
    width: 210mm;
    min-height: 297mm;
    padding: 20mm;
    margin: auto;
    border: 1px solid #eee;
    font-size: 13px;
    background: #fff;
}

.header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.title h1 {
    text-align: right;
}

.info-section {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.info-section table td {
    padding: 3px 10px;
}

.items {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.items th, .items td {
    border: 1px solid black;
    padding: 6px;
    text-align: center;
}

.items th {
    background: black;
    color: white;
}

.totals {
    margin-top: 20px;
    float: right;
}

.totals table td {
    padding: 5px 15px;
}

.grand td {
    font-weight: bold;
    border-top: 2px solid black;
}

.footer {
    margin-top: 60px;
    display: flex;
    justify-content: space-between;
}

.sign {
    text-align: center;
}
</style>
@endsection