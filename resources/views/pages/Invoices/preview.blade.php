@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Invoice {{ $invoices->invoice_number }}</div>
                        <table class="table" style="width: 100%;min-height: 25mm;height: 25mm;margin:0px; padding:0;">
                            <tr class="border">
                                <td class="border" rowspan="3">
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
                                    <small>Vat No : {{ $invoices->customer->customer_vat_number }}</small>
                                </td>
                                <td class="info-td border" style="height: 8mm">
                                    <small>Date : {{ $invoices->invoice_date }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="info-td border" style="height: 8mm">
                                    <small>Terms : {{ $invoices->getPaymentTerm() }}</small>
                                </td>
                                <td class="info-td border" style="">
                                    <small>Invoice No. {{ $invoices->invoice_number }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="info-td border" style="height: 8mm">
                                    <small>Purchase Order No. {{ $invoices->po_number }}</small>
                                </td>
                                <td class="info-td border" style="">
                                    <small>D. N. NO. {{ $invoices->ref_number}}</small>
                                </td>
                            </tr>
                        </table>
                        <table style="height: 114.2mm; font-size: 14px">
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
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 20mm;">Weight</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 16mm;">Ord. Qty.
                                            </td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 22.5mm;">Unit Rate
                                                (Rs.)</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 22.5mm;">Discount
                                                (Rs.)</td>
                                            <td align="center" class="border"
                                                style="height: 6mm;min-height:6mm; max-height:6mm; width: 32mm;">Amount
                                                (Rs.)</td>
                                        </tr>
                                        @foreach ($invoices->items as $key => $item)
                                            <tr class="border">
                                                <td align="center" class="border" style="padding:1rem 0">
                                                    {{ $key + 1 }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->description }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->uom }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->uom }}</td>
                                                <td align="center" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;">
                                                    {{ $item->quantity }}</td>
                                                <td align="right" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                                    {{ money($item->unit_price) }}</td>
                                                <td align="right" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                                    {{ money($item->item_discount_amount) }}</td>
                                                <td align="right" class="border"
                                                    style="height: 6mm;min-height:6mm; max-height:6mm; width: 11mm;padding:0 10px">
                                                    {{ money($item->total) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6"></td>
                                            <td align="right" class="border"
                                                style="height: 26mm;min-height:26mm; max-height:26mm; width: 11mm; padding:10px 10px; background-color: lightgray">
                                                <div style="height:7px">Total(Rs.)</div></br>
                                                @if ($invoices->type != 1 && in_array($invoices->option, [1, 2]))
                                                    <div style="height:7px">Ex. Of Vat(Rs.)</div></br>
                                                @endif

                                                @if ($invoices->type != 1)
                                                    <div style="height:7px">Vat {{ $invoices->vat_rate }}</div></br>
                                                @endif
                                                @if ($invoices->discount_amount > 0)
                                                    <div style="height:7px">Dicount(Rs.)</div></br>
                                                @endif
                                                <div style="height:7px">Grand Total(Rs.)</div></br>

                                            </td>
                                            <td align="right" class="border"
                                                style="height: 26mm;min-height:26mm; max-height:26mm; width: 11mm;padding:10px 10px">
                                                <div style="height:7px">
                                                    {{ money($invoices->sub_total) }}
                                                </div></br>
                                                @if ($invoices->type != 1 && $invoices->option == 1)
                                                    <div style="height:7px">{{ money($invoices->sub_total) }}</div></br>
                                                @endif
                                                @if ($invoices->type != 1 && $invoices->option == 2)
                                                    <div style="height:7px">
                                                        {{ money($invoices->sub_total - $invoices->vat_amount) }}</div>
                                                    </br>
                                                @endif
                                                @if ($invoices->type != 1)
                                                    <div style="height:7px">{{ money($invoices->vat_amount) }}</div></br>
                                                @endif
                                                @if ($invoices->discount_amount > 0)
                                                    <div style="height:7px">
                                                        {{ $invoices->discount_type == 'percentage' ? money($invoices->sub_total * ($invoices->discount_amount/100)) : money($invoices->discount_amount) }}
                                                    </div>
                                                    </br>
                                                @endif
                                                <div style="height:7px">{{ money($invoices->grand_total) }}</div></br>
                                            </td>
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
