@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Department List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('department.index') }}" class="btn btn-primary float-end mb-2"> Department List </a>
                        </div>
                        <table class="table table-bordered" id="tbl_department">
                            <thead>
                                <tr>
                                    <td>Department Number</td>
                                    <td>Department Name</td>
                                    <td>Department Description</td>
                                    {{-- <td>Remark</td> --}}
                                    <td>Deleted By</td>
                                    <td>Deleted At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->department_number}}</td>
                                    <td>{{ $department->department_name}}</td>
                                    <td>{{ $department->department_description}}</td>
                                    {{-- <td>{{ $department->remark}}</td> --}}
                                    <td>{{ $department->deleteUser ? $department->deleteUser->name : 'User not found' }}</td>
                                    <td>{{ $department->deleted_at }}</td>
                                    {{-- <td>
                                        <a href="{{ route('department.restore', $department->id) }}">
                                        <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('department.delete.force', $department->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </a>
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
        $(document).ready( function () {
            $('#tbl_department').DataTable();
        } );
    </script>
@endpush
