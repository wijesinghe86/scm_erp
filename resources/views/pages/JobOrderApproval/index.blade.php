@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Job Order Approval Registry
                            </h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('joborderapproval.create') }}" class="btn btn-success float-end mb-2">
                                    Approve </a>
                            </div>
                            <table class="table table-bordered" id="pps_table">
                                <thead>
                                    <td>#</td>
                                    <td>Job Order Number</td>
                                    <td>Job Order Date</td>
                                    <td>Stock Number</td>
                                    <td>PPS Number</td>
                                    <td>Plant Number</td>
                                    <td>Job Order Quantity</td>
                                    <td>Created By</td>
                                    <td>Status</td>
                                    <td>Approved By</td>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->job_order->job_order_no }}</td>
                                            <td>{{ $item->job_order->jo_date }}</td>
                                            <td>{{ $item->stock_item->stock_number }}</td>
                                            <td>{{ $item->production_planing->pps_no }}</td>
                                            <td>{{ $item->job_order->plant->plant_number }}</td>
                                            <td>{{ $item->jo_qty }}</td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>{{ $item->approval_status }}</td>
                                            <td>{{ $item->approvedBy->name }}</td>
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
        // $(document).ready(function() {
        //     $('#pps_table').DataTable();
        // });
    </script>
@endpush
