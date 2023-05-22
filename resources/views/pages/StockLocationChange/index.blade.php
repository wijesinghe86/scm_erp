@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Stock Location Change List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('stocklocationchange.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('stocklocationchange.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_disposal">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Stock Location Change Number</td>
                                    <td>Stock Location Change Date</td>
                                    <td>From Stock Number</td>
                                    {{-- <td>To Stock Number</td> --}}
                                    <td>From Warehouse Code</td>
                                    {{-- <td>To Warehouse Code</td>
                                    <td>Issued Quantity</td>
                                    <td>Received Quantity</td>
                                    <td>Remarks</td>
                                    <td>Issued By</td>
                                    <td>Issued Date</td>
                                    <td>Fleet Number</td>
                                    <td>Delivered By</td>
                                    <td>Delivered Date</td>
                                    <td>Received By</td>
                                    <td>Received Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($stocklocationchanges as $stocklocationchange)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $stocklocationchange->stock_location_change_number}}</td>
                                    <td>{{ $stocklocationchange->stock_location_change_date}}</td>
                                    <td>{{ $stocklocationchange->from_stock_number}}</td>
                                    <td>{{ $stocklocationchange->to_stock_number}}</td>
                                    <td>{{ $stocklocationchange->from_warehouse_code}}</td>
                                    <td>{{ $stocklocationchange->to_warehouse_code}}</td>
                                    <td>{{ $stocklocationchange->issued_quantity}}</td>
                                    <td>{{ $stocklocationchange->received_quantity}}</td>
                                    <td>{{ $stocklocationchange->remarks}}</td>
                                    <td>{{ $stocklocationchange->issuedby}}</td>
                                    <td>{{ $stocklocationchange->issued_date}}</td>
                                    <td>{{ $stocklocationchange->fleet_number}}</td>
                                    <td>{{ $stocklocationchange->delivered_by}}</td>
                                    <td>{{ $stocklocationchange->delivered_date}}</td>
                                    <td>{{ $stocklocationchange->received_by}}</td>
                                    <td>{{ $stocklocationchange->received_date}}</td>

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
            $('#tbl_disposal').DataTable();
        } );
    </script>
@endpush
