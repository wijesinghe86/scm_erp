@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{-- @include('pages.Invoices.pdf') --}}
                        {{-- <table class="" style="width: 100%;margin:0px;min-height: 30mm;">
                            <tr align="center">
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
                            </tr>
                        </table> --}}
                        <div class="card-title">Invoice {{ $invoices->invoice_number }}</div>
                        <table class="table" style="width: 100%;min-height: 25mm;height: 25mm;margin:0px; padding:0;">
                            <tr class="border">
                                <td class="info-td border" rowspan="3">
                                    <div style="display: flex; gap:10px;">
                                        <div>Invoice To : </div>
                                        <div>
                                            <div>{{ $invoices->customer->customer_name }}</div>
                                            <small>{{ $invoices->customer->customer_address_line1 }}</small><br>
                                            <small>{{ $invoices->customer->customer_address_line1 }}</small><br>
                                            <small>{{ $invoices->customer->customer_mobile_number }}</small><br>
                                            <small>{{ $invoices->customer->customer_email }}</small><br>
                                        </div>
                                    </div>
                                </td>
                                <td class="info-td border" style="height: 8mm">
                                </td>
                                <td class="info-td border" style="height: 8mm">
                                    <small>Date : {{ $invoices->invoice_date }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="info-td border" style="height: 8mm">
                                    <small>Terms : {{ $invoices->payment_terms }}</small>
                                </td>
                                <td class="info-td border" style="">
                                    <small>Invoice No. {{ $invoices->invoice_number }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="info-td border" style="height: 8mm">
                                    <small>Purchase Order No. {{ $invoices->payment_terms }}</small>
                                </td>
                                <td class="info-td border" style="">
                                    <small>D. N. NO. {{ $invoices->invoice_date }}</small>
                                </td>
                            </tr>
                        </table>
                        <table style="height: 114.2mm">
                            <tr>
                                <td class="info-td border">
                                    <table>
                                        <tr style="background-color: black;color:white;" class="border">
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">No.</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 86mm;">Description
                                            </td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 14mm;">U/M</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 16mm;">Ord. Qty.
                                            </td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 20mm;">Weight</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 22.5mm;">Unit Rate
                                                (Rs.)</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 32mm;">Amount
                                                (Rs.)</td>
                                        </tr>
                                        @foreach ($invoices->items as $key => $item)
                                            <tr class="border">
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $key + 1 }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->description }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->uom }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->quantity }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->uom }}</td>
                                                <td align="right" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                                    {{ $item->unit_price }}</td>
                                                <td align="right" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                                    {{ $item->sub_total }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5"></td>
                                            <td align="right" class="border"
                                                style="height: 26mm;min-height:26mm; max-height:26mm; width: 11mm; padding:0 10px; background-color: darkgray">
                                                {{ $invoices->items->sum('unit_price') }}</td>
                                            <td align="right" class="border"
                                                style="height: 26mm;min-height:26mm; max-height:26mm; width: 11mm;padding:0 10px">
                                                {{ $invoices->items->sum('sub_total') }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="display: flex;justify-content: flex-end; align-items: center; margin: 20px 0">
                            <a target="_blank" href="{{ route('invoices.print', ['invoice_id' => $invoices->id]) }}"
                                class="btn btn-secondary mr-5"> Print</a>
                            <a href="{{ route('invoices.all') }}" class="btn btn-primary"> Previous</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @page {
            margin-bottom: 0px;
        }

        .mr-5 {
            margin-right: 10px;
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

        .border {
            border: 1px solid black;
        }
    </style>
@endsection
