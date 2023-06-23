@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4> <a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Raw Material Issuance Registry</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('goodsissuenote.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('goodsissuenote.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a>  --}}
                    </div>
                        <table class="table table-bordered" id="tbl_goodsissuenote">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Customer Code</td>
                                    <td>Stock Number</td>
                                    <td>Issuing Goods Number</td>
                                    <td>Invoice Number</td>
                                    <td>Picking Location</td>
                                    {{-- <td>Warehouse Code</td>
                                    <td>Request Quantity</td>
                                    <td>Issued Quantity</td>
                                    <td>Issued By</td>
                                    <td>Issued Date</td>
                                    <td>Approved By</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>

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
            $('#tbl_goodsissuenote').DataTable();
        } );
    </script>
@endpush
