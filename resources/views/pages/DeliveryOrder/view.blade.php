@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header">
                            <h4 class="title"> Delivery Order {{ $delivery_order->delivery_order_no }} </h4>
                            <div class="card-body">
                                <div class="content">
                                    <div class="row">
                                        <div class="form-group col-md-6 info-item">
                                            <div>Invoice Number :</div>
                                            <div>{{ $delivery_order->invoice_number }}</div>
                                        </div>
                                        <div class="form-group col-md-6 info-item">
                                            <div>Invoice Date :</div>
                                            <div>{{ $delivery_order->invoice_date }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 info-item">
                                            <div>Created By :</div>
                                            <div>
                                                {{ $delivery_order->createdBy ? $delivery_order->createdBy->name : 'User not found' }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 info-item">
                                            <div>Location :</div>
                                            <div>{{ optional($delivery_order->location)->warehouse_name }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 info-item">
                                            <div>Issued Date :</div>
                                            <div>
                                                {{ $delivery_order->issued_date ? $delivery_order->issued_date : 'Not Issued' }}
                                            </div>
                                        </div>
                                    </div>
                                    @if (!$delivery_order->issued_date)
                                    <div class="col-md-4" style="margin-bottom:20px;">
                                        <a href="{{ route('deliveryorders.issueIndex', $delivery_order->id) }}"
                                            class="btn btn-success btn-round new-invoice-button">Issue Delivery Order</a>
                                    </div>
                                    @endif
                                    <table class="table table-bordered" id="tbl_finishedgoods">
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <td>STOCK NO</td>
                                                <td>DESCRIPTION</td>
                                                <td>U/M</td>
                                                <td>ORDERED QTY</td>
                                                <td>ISSUED QTY</td>
                                                <td>BALANCE QTY</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($delivery_order->items as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->stock_no }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->uom }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->issued_qty }}</td>
                                                    <td>{{ $item->available_qty }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a target="_blank" href="{{ route('deliveryorders.print', ['delivery_order_id' => $delivery_order->id]) }}"
                                class="btn btn-secondary mr-5"> Print</a>
                            <a class="btn btn-danger" href="{{route('deliveryorders.all')}}" >D/O Registry</a>
                        </div>
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
