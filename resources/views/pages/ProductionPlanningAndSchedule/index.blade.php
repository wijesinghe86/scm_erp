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
                                    <td>PPS Number</td>
                                    {{-- <td>Plant Number</td> --}}
                                    <td>PPS Date</td>
                                    <td>Production Start Date</td>
                                    <td>Production End Date</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productionplanningandschedules as $productionplanningandschedule)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $productionplanningandschedule->pps_no}}</td>
                                    {{-- <td>{{ $productionplanningandschedule->plant_number}}</td> --}}
                                    <td>{{ $productionplanningandschedule->pps_date}}</td>
                                    <td>{{ $productionplanningandschedule->start_date}}</td>
                                    <td>{{ $productionplanningandschedule->end_date}}</td>
                                    
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
        $(document).ready( function () {
            $('#tbl_productionplanningandschedule').DataTable();
        } );
    </script>
@endpush
