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
                                    <form method="POST"
                                        action="{{ route('deliveryorders.issueStore', $delivery_order->id) }}">
                                        @csrf
                                        <table class="table table-bordered" id="tbl_finishedgoods">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <td>STOCK NO</td>
                                                    <td>DESCRIPTION</td>
                                                    <td>U/M</td>
                                                    <td>ORDERED QTY</td>
                                                    <td>AVAILABLE QTY</td>
                                                    <td>ISSUE QTY</td>
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
                                                        <td>{{ $item->available_qty }}</td>
                                                        <td>
                                                            <input type="number" class="form-control" value="0"
                                                                name="items[{{ $item->id }}][issue_quantity]"
                                                                placeholder="Issue Quantity">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div style="display:flex;justify-content: flex-end; align-items: center; gap:1rem;">
                                            <button class="btn btn-danger">Cancel</button>
                                            <button class="btn btn-success">Issue Delivery</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
