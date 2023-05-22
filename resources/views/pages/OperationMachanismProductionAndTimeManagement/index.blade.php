@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Operation Mechanism Production And Time Management</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('operationmachanismproductionandtimemanagement.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('operationmachanismproductionandtimemanagement.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_operationmachanismproductionandtimemanagement">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Date</td>
                                <td>Production Planning Schedule Number</td>
                                <td>Job Order Number</td>
                                {{-- <td>Time Fraction</td>
                                <td>Stock Level</td>
                                <td>Backlog Level</td>
                                <td>Cost</td>
                                <td>Stock Cost</td>
                                <td>Storage Capacity</td>
                                <td>Demand</td>
                                <td>Production</td>
                                <td>Setup Time</td>
                                <td>Warmup Time</td>
                                <td>Production Time</td>
                                <td>Planning Engine</td>
                                <td>Capacity Model</td>
                                <td>Planning Factors</td>
                                <td>Business Rules</td>
                                --}}
                                <td>Created By</td>
                                {{-- <td>Approved by</td> --}}
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($operationmachanismproductionandtimemanagements as $operationmachanismproductionandtimemanagement)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->date}}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->production_planning_schedule_number }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->job_order_number}}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->time_fraction }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->stock_level }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->backlog_level }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->cost }}</td>
                             <td>{{ $operationmachanismproductionandtimemanagement->stock_cost }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->storage_capacity }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->demand}}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->production }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->setup_time }}</td>
                             <td>{{ $operationmachanismproductionandtimemanagement->warmup_time }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->production_time }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->planning_engine}}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->capacity_model }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->planning_factors}}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->business_rules }}</td>
                            <td>{{ $operationmachanismproductionandtimemanagement->createUser ? $operationmachanismproductionandtimemanagement->createUser->name : 'User not found' }}

                                <td>
                                    @if ($operationmachanismproductionandtimemanagement->operationmachanismproductionandtimemanagement_status == 1)
                                        <a href="{{ route('operationmachanismproductionandtimemanagement.deactive', $operationmachanismproductionandtimemanagement->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('operationmachanismproductionandtimemanagement.active', $operationmachanismproductionandtimemanagement->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('operationmachanismproductionandtimemanagement.view', $operationmachanismproductionandtimemanagement->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('operationmachanismproductionandtimemanagement.edit', $operationmachanismproductionandtimemanagement->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('operationmachanismproductionandtimemanagement.delete', $operationmachanismproductionandtimemanagement->id) }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
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
            $('#tbl_operationmachanismproductionandtimemanagement').DataTable();
        } );
    </script>
@endpush
