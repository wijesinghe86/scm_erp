@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Stock Location Change List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('stocklocationchange.create') }}" class="btn btn-success float-end mb-2">
                                    Add New </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_disposal">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Stock Location Change Number</td>
                                            <td>Stock Location Change Date</td>
                                            <td>From Warehouse Code</td>
                                            <td>To Warehouse Code</td>
                                            <td>Fleet</td>
                                            <td>Driver Name</td>
                                            <td>Issued By</td>
                                            <td>Issued Date</td>
                                            {{-- <td>Delivered Date</td> --}}
                                            {{-- <td>Received By</td> --}}
                                            {{-- <td>Received Date</td> --}}
                                            <td>Remarks</td>
                                            <td>Items</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stock_location_changes as $stock_location_change)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $stock_location_change->slc_number }}</td>
                                                <td>{{ $stock_location_change->slc_date }}</td>
                                                <td>{{ $stock_location_change->from_warehouse->warehouse_name }}</td>
                                                <td>{{ $stock_location_change->to_warehouse->warehouse_name }}</td>
                                                <td>{{ $stock_location_change->fleet->fleet_name }}</td>
                                                <td>{{ $stock_location_change->delivered_by }}</td>
                                                <td>{{ $stock_location_change->issuedBy->employee_fullname }}</td>
                                                <td>{{ $stock_location_change->issued_date }}</td>
                                                {{-- <td>{{ $stock_location_change->delivered_date }}</td> --}}
                                                {{-- <td>{{ $stock_location_change->receivedBy->employee_fullname }}</td> --}}
                                                {{-- <td>{{ $stock_location_change->received_date }}</td> --}}
                                                <td>{{ $stock_location_change->remarks }}</td>
                                                <td>
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td>#</td>
                                                            <td>Stock Number</td>
                                                            <td>Description</td>
                                                            <td>Qty</td>
                                                        </tr>
                                                        @foreach ($stock_location_change->items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->stock_item->stock_number }}</td>
                                                                <td>{{ $item->stock_item->description }}</td>
                                                                <td>{{ $item->qty }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_disposal').DataTable();
        });
    </script>
@endpush
