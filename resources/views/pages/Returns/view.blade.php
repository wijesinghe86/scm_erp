@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title"> Return {{ $invoice_return->return_no }} </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Invoice Number :</div>
                                <div>{{ $invoice_return->invoice->invoice_number }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Invoice Date :</div>
                                <div>{{ $invoice_return->invoice->invoice_date }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>DO Number :</div>
                                <div>{{ $invoice_return->deliveryOrder->delivery_order_no }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Location :</div>
                                <div>{{ $invoice_return->location->warehouse_name }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Created Date :</div>
                                <div>{{ date('Y-m-d', strtotime($invoice_return->created_at)) }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Payment Method :</div>
                                <div>{{ $invoice_return->payment_method == '1' ? 'Cash' : 'Credit' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Created By :</div>
                                <div>{{ $invoice_return->createdBy->name }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Approved :</div>
                                <div>{{ $invoice_return->approvedBy ? $invoice_return->approvedBy->name : 'Not Approved' }}</div>
                            </div>
                        </div>
                        @if (!$invoice_return->is_approved)
                            <form class="row form-group" method="POST"
                                action="{{ route('returns.approval', $invoice_return->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success col-sm-2">Approve</button>
                            </form>
                        @endif
                        <table class="table table-bordered" id="tbl_finishedgoods">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>STOCK NO</td>
                                    <td>DESCRIPTION</td>
                                    <td>U/M</td>
                                    <td>QUANTITY</td>
                                    {{-- <td>UNIT PRICE</td>
                                    <td>TOTAL</td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice_return->items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->stock_no }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->uom }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        {{-- <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->total }}</td> --}}
                                    </tr>
                                @endforeach
                                {{-- <tr>
                                    <td colspan="6" align="right">Total</td>
                                    <td>{{ $invoice_return->items->sum('total') }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                        <a href="{{ route('returns.all') }}">
                            <button class="btn btn-light">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    </style>
@endsection
