@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Purchase Request Through Material Request</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('mrfprf.create') }}" class="btn btn-success float-end mb-2"> Create New </a>
                        {{-- <a href="{{ route('department.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_mrfprf">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>PRF Date</td>
                                    <td>PRF No</td>
                                    <td>Created By</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach ($mrfprfs as $mrfprf)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $mrfprf->mrfprf_date }}</td>
                                    <td>{{ $mrfprf->mrfprf_no }}</td>
                                    <td>{{ $mrfprf->createUser ? $mrfprf->createUser->name : 'User not found' }}</td>
                                </tr>
                            @endforeach --}}
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
            $('#tbl_mrfprf').DataTable();
        } );
    </script>
@endpush
