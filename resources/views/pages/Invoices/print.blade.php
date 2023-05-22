

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice-header">
    <tbody>
        <tr class="row-bg">
            <td width="80%" align="center" class="td-style">

            </td>
        </tr>
    </tbody>
</table>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tbody class="second-block">
        <tr class="row-bg">
            <td width="40%" align="left" class="td-style">
                {{ $invoice->customer ? $invoice->customer->name : '' }}
            </td>
            <td width="18%" align="left" class="td-style">
                Vat No
            </td>
            <td width="15%" align="center" class="td-style">
                {{ $invoice->customer ? $invoice->customer->vat_no : '' }}
            </td>
            <td width="12%" align="left" class="td-style">
                &nbsp;
            </td>
            <td width="15%" align="left" class="td-style">
                <div style="text-align: center"><b>{{ $invoice->created_at->format('d-M-Y') }}</b></div>
            </td>
        </tr>
        <tr class="row-bg">
            <td width="40%" align="left" class="td-style">
                {{ $invoice->customer ? $invoice->customer->address_1 : '' }},
                {{ $invoice->customer ? $invoice->customer->address_2 : '' }}
            </td>
            <td width="18%" align="left" class="td-style">
                &nbsp;
            </td>
            <td width="15%" align="center" class="td-style">
                <div style="text-align: center">
                    @if ($invoice->term == 1)
                        <b>Cash</b>
                    @else
                        <b>Credit</b>
                    @endif
                </div>
            </td>
            <td width="12%" align="left" class="td-style">
                &nbsp;
            </td>
            <td width="15%" align="left" class="td-style">
                <div style="text-align: center"><b>{{ $invoice->invoice_no }}</b></div>
            </td>
        </tr>
        <tr class="row-bg">
            <td width="40%" align="left" class="td-style">

            </td>
            <td width="18%" align="left" class="td-style">
                &nbsp;
            </td>
            <td width="15%" align="left" class="td-style">
                <div style="text-align: center"><b>{{ $invoice->po_no }}</b></div>
            </td>
            <td width="12%" align="left" class="td-style">
                &nbsp;
            </td>
            <td width="15%" align="left" class="td-style">

            </td>
        </tr>
    </tbody>
</table>
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice-table">
    <thead class="">
        <tr class="row-bg invoice-table-head">
            <td width="11%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
            <td width="86%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
            <td width="14%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
            <td width="16%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
            <td width="20%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
            <td width="22.5%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
            <td width="32%" align="center" class="td-style center-text">
                &nbsp; &nbsp;
            </td>
        </tr>
    </thead>
    <tbody class="invoice-table-body">
        @foreach ($items as $key => $item)
            <tr class="row-bg">
                <td width="11%" align="left" class="td-style">
                    {{ ++$key }}
                </td>
                <td width="86%" align="left" class="td-style">
                    {{ $item->description }}
                </td>
                <td width="14%" align="left" class="td-style right-text">
                    {{ $item->uom }}
                </td>
                <td width="16%" align="left" class="td-style right-text">
                    {{ $item->qty }}
                </td>
                <td width="20%" align="left" class="td-style">

                </td>
                <td width="22.5%" align="left" class="td-style right-text">
                    {{ number_format($item->unit_price, 2) }}
                </td>
                <td width="32%" align="left" class="td-style right-text">
                    {{ number_format($item->sub_total, 2) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice-footer">
    <tbody class="">
        @if ($invoice->type != 1 && $invoice->option == 2)
        <tr class="row-bg">
            <td width="10%" align="left" class="td-style">

            </td>
            <td width="47%" align="left" class="td-style">

            </td>

            <td width="20%" align="center" class="td-style">

            </td>
            <td width="14%" align="left" class="td-style">
                Total
            </td>
            <td width="12%" align="left" class="td-style right-text">
                <b>{{ number_format($invoice->net_total, 2) }}</b>
            </td>
        </tr>
        @endif
        <tr class="row-bg">
            <td width="10%" align="left" class="td-style">

            </td>
            <td width="47%" align="left" class="td-style">
                User Id : {{ Auth::user()->name }} &nbsp; &nbsp; Sales Code : {{ $invoice->sales_staff_code }}
            </td>

            <td width="20%" align="center" class="td-style">

            </td>
            <td width="14%" align="left" class="td-style">
                @if ($invoice->type != 1)
                    Ex.of VAT (Rs.)
                @else
                    Total (Rs.)
                @endif
            </td>
            <td width="12%" align="left" class="td-style right-text">
                <b>{{ number_format($invoice->net_total - $invoice->vat_amount, 2) }}</b>
            </td>
        </tr>
        <tr class="row-bg">
            <td width="10%" align="left" class="td-style">

            </td>
            <td width="47%" align="left" class="td-style">
              Date & Time :  {{ Carbon\Carbon::now()->format('Y-m-d H:m:s') }}
            </td>

            <td width="20%" align="center" class="td-style">

            </td>
            @if ($invoice->type != 1)
                <td width="14%" align="left" class="td-style">
                    Vat ({{ $invoice->vat }}%)
                </td>
                <td width="12%" align="left" class=" td-style right-text">
                    <b>{{ number_format($invoice->vat_amount, 2) }}</b>
                </td>
            @else
                <td width="14%" align="left" class="td-style">

                </td>
                <td width="12%" align="left" class=" td-style right-text">

                </td>
            @endif

        </tr>
        @if ($invoice->discount_percentage > 0)
            <tr class="row-bg">
                <td width="10%" align="left" class="td-style">

                </td>
                <td width="47%" align="left" class="td-style">

                </td>

                <td width="20%" align="center" class="td-style">

                </td>
                <td width="14%" align="left" class="td-style">
                    Discount ({{ $invoice->discount_percentage }}%)
                </td>
                <td width="12%" align="left" class=" td-style right-text">
                    <b>{{ number_format($invoice->discount_amount, 2) }}</b>
                </td>
            </tr>
        @endif
        <tr class="row-bg">
            <td width="10%" align="left" class="td-style">

            </td>
            <td width="47%" align="left" class="td-style">

            </td>

            <td width="20%" align="center" class="td-style">

            </td>
            <td width="14%" align="left" class="td-style">
                Grand Total (Rs.)
            </td>
            <td width="12%" align="left" class=" td-style right-text">
                <b>{{ number_format($invoice->grand_total, 2) }}</b>
            </td>
        </tr>
    </tbody>
</table>
<style>
    .page_break {
        page-break-before: always;
    }

    .customer_name {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .right-text {
        text-align: right;
        padding-right: 5px;
    }

    .row-style {
        padding-left: 0px;
        padding-right: 0px;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .row-bg {
        background-color: #ffffff;
    }

    .row-bg-subtotal {
        background-color: #e8e8e8c4;
    }

    .row-bg-head {
        background-color: #dcdcdcb1;
    }

    .row-white {
        background-color: #ffffff;
    }

    .td-style {
        font-family: arial;
        font-size: 11px;
        font-weight: 400;
        line-height: 17px;
        padding-left: 10px;
        padding-bottom: 3px;
        padding-top: 3px;
    }

    .td-style-head {
        font-family: arial;
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        padding-left: 10px;
        padding-bottom: 1px;
        padding-top: 1px;
    }

    .td-style-gt {
        font-family: arial;
        font-size: 14px;
        font-weight: 400;
        line-height: 17px;
        padding-left: 10px;
        padding-bottom: 6px;
        padding-top: 6px;
    }

    .signature {
        text-align: center;
        line-height: 10px;
    }

    .signature-section {
        margin-top: 50px;
    }

    .material-img {
        height: 120px;
        position: fixed;
        right: 150px;
        top: 160px;
        z-index: 999999;
        padding: 5px 0px 5px 0px;
    }

    .border-mb {
        border-bottom: #000000 solid 1px;
    }

    .border-mt {
        border-top: #000000 solid 1px;
    }

    .border-b {
        border-bottom: #000000 solid 1px;
    }

    .border-t {
        border-top: #000000 solid 1px;
    }

    .border-l {
        border-left: #000000 solid 1px;
    }

    .border-r {
        border-right: #000000 solid 1px;
    }

    .brand-logo {
        width: 150px;
        padding-bottom: 2px;
        padding-top: 2px;
    }

    .heading-bg {
        background-color: #e8e8e8c4;
    }

    .heading-bg-po {
        background-color: #ffffff7d;
        color: #2b2b2b;
    }

    .total-bg {
        background-color: #e8e8e8c4;
        padding-right: 10px;
        font-family: arial;
        font-size: 10px;
        font-weight: 400;
        line-height: 20px;
        padding-left: 10px;
        padding-bottom: 5px;
    }

    .total-txt {
        text-align: left;
        padding-left: 10px;
        font-family: arial;
        font-size: 10px;
        font-weight: 400;
        line-height: 20px;
        font-weight: bold;
    }

    .total-value {
        text-align: right;
        font-family: arial;
        font-size: 10px;
        font-weight: 400;
        line-height: 20px;
        font-weight: bold;
    }

    .table-heading {
        padding-left: 15px;
        font-size: 12px;
    }

    .footer-content {
        text-align: center;
        font-size: 8px;
    }

    .section-table {
        margin-bottom: 20px;
    }

    .section-footer {
        margin-top: 50px;
        margin-bottom: 20px;
    }

    .section-table {
        margin-bottom: 20px;
    }

    .note-area {
        border-bottom: #c8c8c8ab solid 1px;
        border-top: #c8c8c8ab solid 1px;
        border-left: #c8c8c8ab solid 1px;
        border-right: #c8c8c8ab solid 1px;
        border-radius: 5px;
        margin-top: 50px;
    }

    .text {
        text-align: left;
        margin-top: 20px;
        padding-bottom: 20px;
        margin-left: 20px;
    }

    .text-head {
        font-family: Cambria;
        font-size: 30px;
        font-weight: bold;
    }

    .text-body {
        font-family: Cambria;
        font-size: 15px;
    }

    .text-tc {
        font-size: 12px;
        line-height: 20px;
    }

    .vendor-info {
        font-size: 10px;
        line-height: 5px;
    }

    .br_image {
        width: 150px;
    }

    .invoice-header {
        height: 70pt;
    }

    .second-block {
        height: 71pt;
    }

    .invoice-header-hr {
        border-top: 1px solid rgb(97, 97, 97);
        margin-top: 0px;
        margin-bottom: 0px;
        width: 60%
    }

    .invoice-table-head {
        height: 17pt;
    }

    .invoice-table {
        height: 330pt;
    }

    .invoice-footer {
        height: 74pt;
        /* margin-bottom: 5pt; */
    }
</style>
