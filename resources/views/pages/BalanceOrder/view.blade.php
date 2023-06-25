@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title"> Balance Order {{ $balance_order->balance_order_no }} </h4>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Delivery Order Number :</div>
                                <div>{{ $balance_order->deliveryOrder->delivery_order_no }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Invoice Number :</div>
                                <div>{{ $balance_order->invoice_number }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Created Date :</div>
                                <div>{{ date('Y-m-d', strtotime($balance_order->created_at)) }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Is Delivery Order Created :</div>
                                <div>{{ $balance_order->is_issued ? 'YES' : 'NO' }}</div>
                            </div>
                        </div>
                        @if (!$balance_order->is_issued)
                            <div class="col-md-4" style="margin-bottom:20px;">
                                <a href="{{ route('balanceorder.delicery_order_create_index', $balance_order->id) }}"
                                    class="btn btn-success btn-round new-invoice-button">Create Delivery Order</a>
                            </div>
                        @endif
                        <table class="table table-bordered" id="tbl_finishedgoods">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>STOCK NO</td>
                                    <td>DESCRIPTION</td>
                                    <td>U/M</td>
                                    <td>BALANCED QTY</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($balance_order->items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->stock_no }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->uom }}</td>
                                        <td>{{ $item->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank"
                            href="{{ route('balanceorder.print', ['balance_order_id' => $balance_order->id]) }}"
                            class="btn btn-secondary mr-5"> Print</a>
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
