@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Plant Time Management Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('planttimemanagement.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('planttimemanagement.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_planttimemanagement">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Production Planning Schedule Number</td>
                                    {{-- <td>Job Order Number</td> --}}
                                    <td>Date</td>
                                    <td>Plant Number</td>
                                    <td>Plant Name</td>
                                    {{-- <td>Raw Materials Loading</td>
                                    <td>Setup</td>
                                    <td>Warmup</td>
                                    <td>Fine Tuning Time</td>
                                    <td>Production Start</td>
                                    <td>Ancipated Process Time</td>
                                    <td>Maintenance</td>
                                    <td>Resuming</td>
                                    <td>Tolerant</td>
                                    <td>Production Finish</td>
                                    <td>Labours Hour</td>
                                    <td>Down Time</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($planttimemanagements as $planttimemanagement)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $planttimemanagement->production_planning_schedule_number}}</td>
                                    <td>{{ $planttimemanagement->job_order_number}}</td>
                                    <td>{{ $planttimemanagement->date}}</td>
                                    <td>{{ $planttimemanagement->plant_number}}</td>
                                    <td>{{ $planttimemanagement->plant_name}}</td>
                                    <td>{{ $planttimemanagement->raw_materials_loading}}</td>
                                    <td>{{ $planttimemanagement->setup}}</td>
                                    <td>{{ $planttimemanagement->warmup}}</td>
                                    <td>{{ $planttimemanagement->fine_tuning_time}}</td>
                                    <td>{{ $planttimemanagement->production_start}}</td>
                                    <td>{{ $planttimemanagement->ancipated_process_time}}</td>
                                    <td>{{ $planttimemanagement->maintenance}}</td>
                                    <td>{{ $planttimemanagement->resuming}}</td>
                                    <td>{{ $planttimemanagement->tolerant}}</td>
                                    <td>{{ $planttimemanagement->production_finish}}</td>
                                    <td>{{ $planttimemanagement->labours_hour}}</td>
                                    <td>{{ $planttimemanagement->down_time}}</td>
                                    <td>
                                        <a href="{{ route('planttimemanagement.edit', $planttimemanagement->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('planttimemanagement.delete', $planttimemanagement->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('planttimemanagement.view', $planttimemanagement->id) }}">
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
            $('#tbl_planttimemanagement').DataTable();
        } );
    </script>
@endpush
