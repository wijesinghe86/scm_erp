<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<head>
    <style>
        @page {
            margin-bottom: 0px;
        }

        .select-none {
            color: transparent;
            user-select: none;
        }

        .w-fit {
            width: fit-content;
        }

        table {
            width: 100%;
            table-layout: fixed;
            /* border: 1px solid black; */
        }

        /* tr {
            border: 1px solid blue !important;
        }

        td {
            border: 1px solid red !important;
        } */

        .info-td {
            vertical-align: top !important;
        }

        .mb-2 {
            margin-bottom: 1rem;
        }
    </style>
    <title>{{ $balance_order->invoice_number }}</title>
</head>

<body>
    <table class="" style="width: 100%;margin:0px;min-height: 30mm;">
        {{-- <tr align="center">
            <td>
                <h1>ABC</h1>
                <hr style="width: 50%;">
            </td>
        </tr>
        <tr align="center">
            <td>
                <div class="mb-2">MANUFACTURER</div>
                <small>Industrial Village,</small><br>
                <small>Tel: oXXXXXXXXX</small><br>
                <small>E-mail</small><br>
            </td>
        </tr> --}}
    </table>
    <table class="table" style="width: 100%;min-height: 25mm;height: 25mm;margin:0px; padding:0;">
        <tr>
            <td class="info-td" rowspan="3" style="padding-left: 25mm">
                <div>{{ $balance_order->customer->customer_name }}</div>
                <small>{{ $balance_order->customer->customer_address_line1 }}</small><br>
                <small>{{ $balance_order->customer->customer_address_line1 }}</small><br>
                <small>{{ $balance_order->customer->customer_mobile_number }}</small><br>
                <small>{{ $balance_order->customer->customer_email }}</small><br>
            </td>
            <td class="info-td" style="height: 8mm">
            </td>
            <td class="info-td " style="padding-left: 23mm; height: 8mm">
                <small>{{ $balance_order->invoice_date }}</small>
            </td>
        </tr>
        <tr>
            <td class="info-td " style="padding-left: 23mm; height: 8mm">
                <small>{{ $balance_order->payment_terms }}</small>
            </td>
            <td class="info-td " style="padding-left: 23mm">
                <small>{{ $balance_order->invoice_number }}</small>
            </td>
        </tr>
        <tr>
            <td class="info-td " style="padding-left: 23mm; height: 8mm">
                <small>{{ $balance_order->payment_terms }}</small>
            </td>
            <td class="info-td " style="padding-left: 23mm">
                <small>{{ $balance_order->invoice_date }}</small>
            </td>
        </tr>
    </table>
    <table style="height: 114.2mm">
        <tr>
            <td class="info-td ">
                <table>
                    <tr>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">No.</td>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 86mm;">Description</td>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 14mm;">U/M</td>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 16mm;">Ord. Qty.</td>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 20mm;">Weight</td>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 22.5mm;">Unit Rate (Rs.)</td>
                        <td align="center" class="select-none"
                            style="height: 6mm;min-height:6mm; max-height:6mm; width: 32mm;">Amount (Rs.)</td>
                    </tr>
                    @foreach ($balance_order->items as $key => $item)
                        <tr>
                            <td align="center" style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                {{ $key + 1 }}</td>
                            <td align="center" style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                {{ $item->description }}</td>
                            <td align="center" style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                {{ $item->uom }}</td>
                            <td align="center" style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                {{ $item->quantity }}</td>
                            <td align="center" style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                {{ $item->uom }}</td>
                            <td align="right"
                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                {{ $item->unit_price }}</td>
                            <td align="right"
                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                {{ $item->sub_total }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td align="right"
                            style="height: 26mm;min-height:26mm; max-height:26mm; width: 11mm; padding:0 10px">
                            {{ $balance_order->items->sum('unit_price') }}</td>
                        <td align="right"
                            style="height: 26mm;min-height:26mm; max-height:26mm; width: 11mm;padding:0 10px">
                            {{ $balance_order->items->sum('sub_total') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
