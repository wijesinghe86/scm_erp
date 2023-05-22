@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Raw Materials Serial Code Assigning Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('rawmaterialsserialcodeassigning.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('rawmaterialsserialcodeassigning.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_rawmaterialsserialcodeassigning">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Goods Receiving Number</td>
                                    <td>Warehouse Code</td>
                                    <td>Supplier Code</td>
                                    <td>Stock Number</td>
                                    <td>Serial Number</td>
                                    {{-- <td>RM Serial Quantity</td>
                                    <td>RM Serial Weight</td>
                                    <td>Created By</td>
                                    <td>Created Date</td> --}}
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($rawmaterialsserialcodeassignings as $rawmaterialsserialcodeassigning)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->grn_number}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->warehouse_code}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->supplier_code}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->stock_number}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->serial_number}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->rm_serial_quantity}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->rm_serial_weight}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->created_by}}</td>
                                    <td>{{ $rawmaterialsserialcodeassigning->created_date}}</td>

                                </tr>
                                @endforeach
                            </tbody> --}}

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
            $('#tbl_rawmaterialsserialcodeassigning').DataTable();
        } );
    </script>
@endpush
