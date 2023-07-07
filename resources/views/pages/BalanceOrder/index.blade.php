@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Balance Order Document List
                            </h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                {{-- <a href="{{ route('balanceorder.create') }}" class="btn btn-success float-end mb-2"> Add New </a> --}}
                                {{-- <a href="{{ route('balanceorder.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table bordered form-group">
                            <table class="table table-bordered" id="tbl_balanceorder">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Balance Order Number</td>
                                        <td>Delivery Order Number</td>
                                        <td>Invoice Number</td>
                                        <td>Delivery Order Created</td>
                                        <td>Date</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($balance_orders as $key => $balance_order)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $balance_order->balance_order_no }}</td>
                                            <td>{{ $balance_order->deliveryOrder->delivery_order_no }}</td>
                                            <td>{{ $balance_order->invoice_number }}</td>
                                            <td>{{ $balance_order->is_issued? "YES" : "NO" }}</td>
                                            <td>{{ date('Y-m-d', strtotime($balance_order->created_at)) }}</td>
                                            <td>
                                                {{-- <a href="{{ route('balanceorder.edit', $balance_order->id) }}">
                                                    <i class="mdi mdi-pencil text-dark"></i>
                                                </a> --}}

                                                {{-- <a href="{{ route('balanceorder.delete', $balance_order->id) }}">
                                                    <i class="mdi mdi-delete text-danger"></i>
                                                </a> --}}
                                                <a class="h4"
                                                    href="{{ route('balanceorder.view', $balance_order->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_balanceorder').DataTable();
        });
    </script>
@endpush
