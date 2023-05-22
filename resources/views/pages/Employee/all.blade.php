@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Employee List</h2>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('employee.new') }}" class="btn btn-success mb-2"> Add New </a>
                                <a href="{{ route('employee.deleted') }}" class="btn btn-danger mb-2"> Delete </a>
                            </div>
                            <table class="table table-bordered" id="tbl_employee">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Employee Name</td>
                                        <td>Employee Name with Initial</td>
                                        <td>NIC No</td>
                                        <td>Created By</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $employee->employee_fullname }}</td>
                                            <td>{{ $employee->employee_name_with_intial }}</td>
                                            <td>{{ $employee->employee_nic_no }}</td>
                                            <td>{{ $employee->createUser?$employee->createUser->name: 'User not found' }}</td>
                                            <td>
                                                @if ($employee->employee_status == 1)
                                                    <a href="{{ route('employee.deactive', $employee->id) }}"
                                                        class="btn btn-primary btn-sm">Deactive</a>
                                                @else
                                                    <a href="{{ route('employee.active', $employee->id) }}"
                                                        class="btn btn-success btn-sm">Active</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('employee.view', $employee->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('employee.edit', $employee->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('employee.delete', $employee->id) }}">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                </a>

                                                {{-- <a href="{{ route('employee.active', $employee->id) }}">
                                                    <i class="mdi mdi-eye"></i>
                                                </a> --}}
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
        $(document).ready(function() {
            $('#tbl_employee').DataTable();
            // "order": [
            //     [0, "desc"]
            // ],
            // "columnDefs": [{
            //     "targets": [0],
            //     "visible":false,
            //     "searchable":false
            // }],
            // "language": [
            //    "search":"Search: "
            // ],
            // "lengthMenu": [
            //     [10, 25, 50, -1],
            //     [10, 25, 50, "All"]
            // ],
        });
    </script>
@endpush
