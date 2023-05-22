@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Supplier List</h4>
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('supplier.all') }}" class="btn btn-primary mb-2"> Supplier List</a>
                        </div>
                        <table class="table table-bordered" id="tbl_supplier">
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Name</td>
                                    <td>BR No</td>
                                    <td>Deleted By</td>
                                    <td>Deleted AT</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->supplier_code }}</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->business_registration_number }}</td>
                                    <td>{{ $supplier->deleteUser?$supplier->deleteUser->name: 'User not found' }}</td>
                                    <td>{{ $supplier->deleted_at }}</td>
                                    {{-- <td>
                                        @if ($employee->employee_status == 1)
                                            <a href="{{ route('employee.deactive', $employee->id) }}"
                                                class="btn-primary btn-round">Deactive</a>
                                        @else
                                            <a href="{{ route('employee.active', $employee->id) }}"
                                                class="btn-primary btn-round">Active</a>
                                        @endif
                                    </td> --}}
                                    {{-- <td>
                                        <a href="{{ route('supplier.restore', $supplier->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i>
                                        </a>
                                        <a href="{{ route('supplier.delete.force', $supplier->id) }}">
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
            $('#tbl_supplier').DataTable();
        });
    </script>
@endpush
