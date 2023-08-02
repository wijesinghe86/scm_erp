@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Department List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('department.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('department.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id="tbl_department">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Department Number</td>
                                    <td>Department Name</td>
                                  <td>Department Description</td>
                                    {{-- <td>Remarks</td> --}}
                                    <td>Created By</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $department->department_number}}</td>
                                    <td>{{ $department->department_name}}</td>
                                <td>{{ $department->department_description}}</td>
                                    {{-- <td>{{ $department->remark}}</td> --}}
                                    <td>{{ $department->createUser ? $department->createUser->name : 'User not found' }}</td>

                                    <td>
                                        @if ($department->department_status == 1)
                                            <a href="{{ route('department.deactive', $department->id) }}"
                                                class="btn btn-primary btn-sm">Deactive</a>
                                        @else
                                            <a href="{{ route('department.active', $department->id) }}"
                                                class="btn btn-success btn-sm">Active</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('department.view', $department->id) }}">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('department.edit', $department->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('department.delete', $department->id) }}">
                                            <i class="fa-solid fa-trash-can text-danger"></i>
                                        </a>


                                    </td>
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
