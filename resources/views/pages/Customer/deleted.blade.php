@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Deleted Customers</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('customer.index') }}" class="btn btn-primary float-end mb-2"> Customer List </a>
                            </div>

                            <table class="table table-bordered" id='tbl_customer'>

                                <thead>
                                    <tr>
                                        <td>Customer Code</td>
                                        <td>Customer Name</td>
                                        <td>Customer Address</td>
                                        <td>Customer Type</td>
                                        <td>Deleted By</td>
                                        <td>Deleted At</td>
                                        </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->customer_code }}</td>
                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customer->customer_address_line1 }}</td>
                                            <td>{{ $customer->customer_type_of_customer }}</td>
                                            <td>{{ $customer->deleteUser?$customer->deleteUser->name: 'User not found' }}</td>
                                            <td>{{ $customer->deleted_at }}</td>
                                            {{-- <td>
                                            <a href="{{ route('customer.restore', $customer->id) }}" >
                                                <i class="fa-solid fa-pen-to-square text-success"></i>
                                               </a>
                                               <a href="{{ route('customer.forcedelete', $customer->id) }}" >
                                               <a href="javascript:void(0)" class="ml-3" onclick="delconf('{{ route('customer.delete', $customer->id) }}')">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                               </a></td> --}}


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
            $('#tbl_customer').DataTable({
                "order": [
                    [0, "asc"]
                ],

                "lenghtMenu":[
                //     [10, 25, 50, -1],
                    [100, 150, 200, "All"]
                ],
            });
        });
    </script>
@endpush
