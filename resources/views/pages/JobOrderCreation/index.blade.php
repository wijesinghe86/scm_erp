@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Job Order Report</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('jobordercreation.create') }}" class="btn btn-success float-end mb-2"> Add
                                    New </a>
                                {{-- <a href="{{ route('jobordercreation.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <table class="table table-bordered" id="tbl_jobordercreation">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Job Order Number</td>
                                        <td>Job Order Date</td>
                                        <td>Stock Number</td>
                                        <td>PPS Number</td>
                                        <td>Plant Number</td>
                                        <td>Job Order Quantity</td>
                                        <td>Created By</td>
                                        {{-- <td>Actions</td> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job_order_items as $job_order_item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $job_order_item->job_order->job_order_no }}</td>
                                            <td>{{ $job_order_item->job_order->jo_date }}</td>
                                            <td>{{ $job_order_item->stock_item->stock_number }}</td>
                                            <td>{{ $job_order_item->production_planing->pps_no }}</td>
                                            <td>{{ $job_order_item->job_order->plant->plant_number }}</td>
                                            <td>{{ $job_order_item->jo_qty }}</td>
                                            <td>{{ $job_order_item->createdBy->name }}</td>
                                            {{-- <td>
                                                <a href="{{ route('jobordercreation.edit', $job_order_item->id) }}">
                                                    <i class="mdi mdi-pencil text-dark"></i></a>

                                                <a href="{{ route('jobordercreation.delete', $job_order_item->id) }}">
                                                    <i class="mdi mdi-delete text-danger"></i></a>

                                                <a href="{{ route('jobordercreation.view', $jobordercreation->id) }}">
                                                    <i class="mdi mdi-eye text-dark"></i></a>
                                            </td> --}}
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
            $('#tbl_jobordercreation').DataTable();
        });
    </script>
@endpush
