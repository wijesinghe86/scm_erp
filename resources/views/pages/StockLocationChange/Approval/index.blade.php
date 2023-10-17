@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Stock Location Change Approval
                            List</h2>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_slcApprove">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Stock Location Change Number</td>
                                            <td>Stock Location Change Date</td>
                                            <td>Stock Location Change Date</td>
                                            <td>From Warehouse Code</td>
                                            <td>To Warehouse Code</td>
                                            <td>Issued By</td>
                                            <td>Issued Date</td>
                                            <td></td>
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
                                                <td>{{ $stock_location_change->issuedBy->employee_fullname }}</td>
                                                <td>{{ $stock_location_change->issued_date }}</td>
                                                <td>{{ $stock_location_change->remarks }}</td>
                                                <td>
                                                    <a
                                                    class="btn btn-primary"
                                                        href="{{ route('stocklocationchange_approvals.create', $stock_location_change->id) }}">View</a>
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
            $('#tbl_slcApprove').DataTable();
        });
    </script>
@endpush
