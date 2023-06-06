@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Goods Received List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('goodsreceived.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('goodsreceived.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a></div> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_goodsreceived">
                            <thead>
                                <tr>
                                    <tr>
                                        <td>No</td>
                                        <td>Supplier </td>
                                        <td>PO Number</td>
                                        {{-- <td>Batch Number</td> --}}
                                        <td>GRN No</td>
                                        <td>GRN Date</td>
                                        {{-- <td>Description</td> --}}
                                       <td>Created By</td>
                                    </tr>
                                </tr>
                            </thead>
                             <tbody>
                                @foreach ($goodsreceiveds as $goodsreceived)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $goodsreceived->supplierDetails->supplier_name}}</td>
                                    <td>{{ $goodsreceived->poDetails->po_no}}</td>
                                    <td>{{ $goodsreceived->grn_no }}</td>
                                    <td>{{ $goodsreceived->grn_date}}</td>
                                    {{-- <td>{{ $goodsreceived->grnItems->item->description }} --}}
                                    <td>{{ $goodsreceived->createUser ? $goodsreceived->createUser->name : 'User not found' }}</td>


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
                $('#tbl_goodsreceived').DataTable();
            } );
        </script>
    @endpush
