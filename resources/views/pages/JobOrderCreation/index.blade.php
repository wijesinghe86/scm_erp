@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Job Order Report</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('jobordercreation.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
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
                                    {{-- <td>Weight</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>supervisor</td>
                                    <td>Created By</td>
                                    <td>Created Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($jobordercreations as $jobordercreation)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $jobordercreation->job_order_number}}</td>
                                    <td>{{ $jobordercreation->job_order_Date}}</td>
                                    <td>{{ $jobordercreation->stock_number}}</td>
                                    <td>{{ $jobordercreation->pps_number}}</td>
                                    <td>{{ $jobordercreation->plant_number}}</td>
                                    <td>{{ $jobordercreation->job_order_quantity}}</td>
                                    <td>{{ $jobordercreation->weight}}</td>
                                    <td>{{ $jobordercreation->start_date}}</td>
                                    <td>{{ $jobordercreation->end_date}}</td>
                                    <td>{{ $jobordercreation->supervisor}}</td>
                                    <td>{{ $jobordercreation->created_by}}</td>
                                    <td>{{ $jobordercreation->created_date}}</td>
                                     <td>
                                        <a href="{{ route('jobordercreation.edit', $jobordercreation->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('jobordercreation.delete', $jobordercreation->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('jobordercreation.view', $jobordercreation->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i></a>
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
            $('#tbl_jobordercreation').DataTable();
        } );
    </script>
@endpush
