@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Deleted Employee List</h2>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('employee.all') }}" class="btn btn-primary mb-2"> Employee List</a>
                            </div>
                            <table class="table table-bordered" id="tbl_employee">
                                <thead>
                                    <tr>
                                        <td>Employee Name</td>
                                        <td>Employee Name with Initial</td>
                                        <td>NIC No </td>
                                        <td>Deleted By</td>
                                        <td>Deleted At</td>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->employee_fullname }}</td>
                                            <td>{{ $employee->employee_name_with_intial }}</td>
                                            <td>{{ $employee->employee_nic_no }}</td>
                                            <td>{{ $employee->deleteUser?$employee->deleteUser->name: 'User not found' }}</td>
                                            <td>{{ $employee->deleted_at }}</td>
                                            {{-- <td>
                                                 @if ($employee->employee_status == 1)
                                                    <a href="{{ route('employee.deactive', $employee->id) }}"
                                                        class="btn-primary btn-round">Deactive</a>
                                                @else
                                                    <a href="{{ route('employee.active', $employee->id) }}"
                                                        class="btn-primary btn-round">Active</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('employee.restore', $employee->id) }}">
                                                    <i class="mdi mdi-pencil text-dark"></i>
                                                </a>
                                                <a href="{{ route('employee.delete.force', $employee->id) }}">
                                                    <i class="mdi mdi-delete text-danger"></i>
                                                </a>
                                                <a href="{{ route('employee.active', $employee->id) }}">
                                                    <i class="mdi mdi-eye"></i>
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
