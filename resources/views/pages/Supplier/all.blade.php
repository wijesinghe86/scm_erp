@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Supplier List</h4>
                        <br>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('supplier.new') }}" class="btn btn-success mb-2"> Add New </a>
                            <a href="{{ route('supplier.deleted') }}" class="btn btn-danger mb-2"> Delete </a>
                        </div>
                        <table class="table table-bordered" id="tbl_supplier">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Code</td>
                                    <td>Name</td>
                                    <td>BR No</td>
                                    <td>Created By</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $supplier->supplier_code }}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->business_registration_number }}</td>
                                        <td>{{ $supplier->createUser ? $supplier->createUser->name : 'User not found' }}
                                        </td>
                                        <td>
                                            @if ($supplier->supplier_status == 1)
                                                <a href="{{ route('supplier.deactive', $supplier->id) }}"
                                                    class="btn btn-primary btn-sm">Deactive</a>
                                            @else
                                                <a href="{{ route('supplier.active', $supplier->id) }}"
                                                    class="btn btn-success btn-sm">Active</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('supplier.view', $supplier->id) }}">
                                                <i class="fa-sharp fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('supplier.edit', $supplier->id) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('supplier.delete', $supplier->id) }}">
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
            $('#tbl_supplier').DataTable();
        });
    </script>
@endpush
