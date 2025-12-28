@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title"> Reverse Return {{$urgent_returns->return_no}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Invoice Number :</div>
                                <div>{{ $urgent_returns->get_invoice->invoice_number }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Invoice Date :</div>
                                <div>{{ $urgent_returns->get_invoice->invoice_date }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>DO Number :</div>
                                <div>{{ $urgent_returns->deliveryOrder->delivery_order_no }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Received Location :</div>
                                <div>{{ $urgent_returns->location->warehouse_name }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Created Date :</div>
                                <div>{{ date('Y-m-d', strtotime($urgent_returns->created_at)) }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Payment Method :</div>
                                <div>{{ $urgent_returns->payment_method == '1' ? 'Cash' : 'Credit' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 info-item">
                                <div>Created By :</div>
                                <div>{{ $urgent_returns->createdBy->name }}</div>
                            </div>
                            <div class="form-group col-md-6 info-item">
                                <div>Approved :</div>
                                <div>{{ $urgent_returns->approvedBy ? $urgent_returns->approvedBy->name : 'Not Approved' }}</div>
                            </div>
                        </div>
                        @if (!$urgent_returns->is_approved)
                            <form class="row form-group" method="POST"
                                action="{{ route('reverse_returns.approval', $urgent_returns->id) }}">
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
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($urgent_returns->items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->stock_no }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->uom }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <a href="{{ route('reverse_returns.index') }}">
                            <button class="btn btn-success">Back</button>
                        </a>
                        <a href="{{ route('reverse_returns.print' ,['return_id'=> $urgent_returns->id]) }}">
                            <button class="btn btn-success">Print</button>
                        </a>
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
