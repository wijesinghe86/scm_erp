@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Dispatch List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('dispatch.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('dispatch.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_dispatch">
                            <thead>
                                <tr>
                                    <td>Dispatch Number</td>
                                    <td>Dispatched Date</td>
                                    <td>FGRN No</td>
                                    <td>From Location</td>
                                    <td>To Location</td>
                                    <td>Dispatched By</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

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
            $('#tbl_dispatch').DataTable();
        } );
    </script>
@endpush
