@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Purchase Order List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('purchase_order_mr.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('purchase_order.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a></div> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_purchase_order">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>PO Date</td>
                                    <td>PO No</td>
                                    <td>Created By</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $list->po_date }}</td>
                                    <td>{{ $list->po_no }}</td>
                                    <td>{{ $list->createUser ? $list->createUser->name : 'User not found' }}</td>
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
    {{-- <script>
        $(document).ready( function () {
            $('#tbl_purchase_order').DataTable();
        } );
    </script> --}}
@endpush
