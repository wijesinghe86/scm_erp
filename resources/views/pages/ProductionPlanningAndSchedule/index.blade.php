@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Production Planning and Schedule Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('productionplanningandschedule.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('productionplanningandschedule.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_productionplanningandschedule">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Production Planning Schedule Number</td>
                                    {{-- <td>Plant Number</td> --}}
                                    <td>Production Planning Schedule Date</td>
                                    <td>Production Start Date</td>
                                    <td>Production End Date</td>
                                    {{-- <td>DF Number</td>
                                    <td>Stock Number</td>
                                    <td>PPS Quantity</td>
                                    <td>Weight</td>
                                    <td>Created By</td>
                                    <td>Create Date</td>
                                    <td>Approved_by</td>
                                    <td>approved_date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($productionplanningandschedules as $productionplanningandschedule)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $productionplanningandschedule->production_planning_schedule_number}}</td>
                                    <td>{{ $productionplanningandschedule->plant_number}}</td>
                                    <td>{{ $productionplanningandschedule->production_planning_schedule_date}}</td>
                                    <td>{{ $productionplanningandschedule->production_start_date}}</td>
                                    <td>{{ $productionplanningandschedule->production_end_date}}</td>
                                    <td>{{ $productionplanningandschedule->df_number}}</td>
                                    <td>{{ $productionplanningandschedule->stock_number}}</td>
                                    <td>{{ $productionplanningandschedule->pps_quantity}}</td>
                                    <td>{{ $productionplanningandschedule->weight}}</td>
                                    <td>{{ $productionplanningandschedule->created_by}}</td>
                                    <td>{{ $productionplanningandschedule->create_date}}</td>
                                    <td>{{ $productionplanningandschedule->approved_by}}</td>
                                    <td>{{ $productionplanningandschedule->approved_date}}</td>
                                    <td>
                                        <a href="{{ route('productionplanningandschedule.edit', $productionplanningandschedule->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('productionplanningandschedule.delete', $productionplanningandschedule->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('productionplanningandschedule.view', $productionplanningandschedule->id) }}">
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
            $('#tbl_productionplanningandschedule').DataTable();
        } );
    </script>
@endpush
