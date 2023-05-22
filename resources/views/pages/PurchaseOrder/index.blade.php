@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Purchase Order List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('purchase_order.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('purchase_order.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a></div> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_purchase_order">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Purchase Order Number</td>
                                    <td>Supplier Code</td>
                                    <td>Purchase Reference Number</td>
                                    <td>Purchase Order Date</td>
                                    <td>Stock Number</td>
                                    <!-- <td>Purchase Order Type</td>
                                    <td>Purchase Order Quantity</td>
                                    <td>Weight Per Unit</td>
                                    <td>Volume Per Unit</td>
                                    <td>Total Weight</td>
                                    <td>Total Volume</td>
                                    <td>Warehouse Code</td>
                                    <td>Weight Per Unit</td>
                                    <td>Total Weight</td>
                                    <td>Total Volume</td>
                                    <td>Purchase Order Price Per Unit</td>
                                    <td>Ship To</td>
                                    <td>Intended Delivery Date</td>
                                    <td>Mode Of Delivery</td>
                                    <td>Approved By</td> -->

                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($purchase_orders as $purchase_order)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $purchase_order->over_short_damage_report_number}}</td>
                                    <td>{{ $purchase_order->grn_number}}</td>
                                    <td>{{ $purchase_order->po_number}}</td>
                                    <td>{{ $purchase_order->supplier_code}}</td>
                                    <td>{{ $purchase_order->stock_number}}</td>
                                    <td>{{ $purchase_order->serial_number}}</td>
                                    <td>{{ $purchase_order->batch_number}}</td>
                                    <td>{{ $purchase_order->quantity}}</td>
                                    <td>{{ $purchase_order->expire_date}}</td>

                                     <td>
                                        <a href="{{ route('disposal.edit', $disposal->id) }}">
                                        <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('disposal.delete', $disposal->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </a>

                                        <a href="{{ route('disposal.view', $disposal->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody> --}}

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_purchase_order').DataTable();
        } );
    </script>
@endpush
