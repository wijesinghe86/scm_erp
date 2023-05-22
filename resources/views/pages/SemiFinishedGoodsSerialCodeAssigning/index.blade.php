@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Semi Finished Goods Serial Code Assigning Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('semifinishedgoodsserialcodeassigning.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('semifinishedgoodsserialcodeassigning.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a>  --}}
                    </div>
                        <table class="table table-bordered" id="tbl_semifinishedgoodsserialcodeassigning">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Semi Finished Goods Serial Number</td>
                                    <td>Goods Receiving Number</td>
                                    <td>Warehouse Code</td>
                                    <td>Stock Number</td>
                                    <td>Raw Materials Serial Quantity</td>
                                    {{-- <td>Raw Materials Serial Weight</td>
                                    <td>Job Order Number</td>
                                    <td>Batch Number</td>
                                    <td>Created By</td>
                                    <td>Created Date</td> --}}
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($semifinishedgoodsserialcodeassignings as $semifinishedgoodsserialcodeassigning)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->semi_finished_goods_serial_number}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->grn_number}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->warehouse_code}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->stock_number}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->rm_serial_quantity}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->rm_serial_weight}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->job_order_number}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->batch_number}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->created_by}}</td>
                                    <td>{{ $semifinishedgoodsserialcodeassigning->created_date}}</td>

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
            $('#tbl_semifinishedgoodsserialcodeassigning').DataTable();
        } );
    </script>
@endpush
