@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>  Name List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('organization.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table bordered form-group">
                            <table class="table table-bordered" id='tbl_customer'>

                                <thead>
                                    <tr>

                                        <td>No</td>
                                        <td>Organization Code</td>
                                        <td>Organization Name</td>
                                        <td>Organization TIN No</td>
                                        <td>Created By</td>
                                        <!-- <td>Status</td>
                                        <td>Action</td> -->
                                        </tr>
                                </thead>

                                <tbody>
                                    @foreach ($organizations as $organization)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $organization->organization_code }}</td>
                                            <td>{{ $organization->organization_name }}</td>
                                            <td>{{ $organization->organization_tin_no }}</td>
                                            <td>{{ $organization->createUser?$organization->createUser->name: 'User not found' }}</td>
                                            
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_customer').DataTable();
        });
    </script>
@endpush

 {{-- @push('scripts')
    <script>
        $(document).ready(function() {
             $('#tbl_customer').DataTable({
                "order": [
                    [0, "asc"]
                 ],

              "lenghtMenu":[
                 [10, 25, 50, -1],
                   [100, 150, 200, "All"]
               ],
           });
         });
    </script>
@endpush --}}
