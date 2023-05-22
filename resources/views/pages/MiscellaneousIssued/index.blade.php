@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Miscellaneous Issued Report</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('miscissued.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('miscellaneousissued.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_miscellaneousissued">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Reference Number</td>
                                    <td>Document Number</td>
                                    <td>Created By</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($miscissued as $miscissue)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $miscissue->ref_number}}</td>
                                    <td>{{ $miscissue->misc_number}}</td>
                                    <td>{{ $miscissue->createUser?$miscissue->createUser->name: 'User not found' }}</td>
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
            $('#tbl_miscellaneousissued').DataTable();
        } );
    </script>
@endpush
