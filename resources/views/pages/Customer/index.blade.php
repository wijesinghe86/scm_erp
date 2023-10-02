@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>  Name List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('customer.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                                <a href="{{ route('customer.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                                <a href="{{ route('customer.print') }}" target="blank" class="btn btn-primary mb-2"> Print </a>

                            </div>
                            <div class="table-responsive">
                                <table class="table bordered form-group">
                            <table class="table table-bordered" id='tbl_customer'>

                                <thead>
                                    <tr>

                                        <td>No</td>
                                        <td>Customer Code</td>
                                        <td>Customer Name</td>
                                        <td>Customer Type</td>
                                        <td>Created By</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                        </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $customer->customer_code }}</td>
                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customer->customer_type_of_customer }}</td>
                                            <td>{{ $customer->createUser?$customer->createUser->name: 'User not found' }}</td>
                                            <td>
                                                @if ($customer->customer_status ==1)
                                                <a href="{{ route('customer.deactive', $customer->id) }}"
                                                    class="btn btn-primary btn-sm">Deactive</a>
                                                    @else
                                                    <a href="{{ route('customer.active', $customer->id) }}"
                                                        class="btn btn-success btn-sm">Active</a>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('customer.view', $customer->id) }}" >
                                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('customer.edit', $customer->id) }}" >
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                   <a href="{{ route('customer.delete', $customer->id) }}" >
                                                   {{-- <a href="javascript:void(0)" class="ml-3" onclick="delconf('{{ route('customer.delete', $customer->id) }}')"> --}}
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                </a>

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
