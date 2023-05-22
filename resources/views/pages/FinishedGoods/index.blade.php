@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Finished Goods List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('finishedgoods.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('finishedgoods.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_finishedgoods">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Finished Goods Number</td>
                                    <td>Raw Material Issue Number</td>
                                    <td>Job Order Number</td>
                                    {{-- <td>PPS Number</td>
                                    <td>Batch Number</td>
                                    <td>Plant Number</td> --}}
                                    <td>Stock Number</td>
                                    <td>Serial Number</td>
                                    {{-- <td>Warehouse Code</td>
                                    <td>Issuing Quantity</td>
                                    <td>Product Quantity</td>
                                    <td>Production Weight</td>
                                    <td>Wastage Quantity</td>
                                    <td>Created By</td>
                                    <td>Created Date</td>
                                    <td>Approved By</td>
                                    <td>Approved Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($finishedgoodss as $finishedgoods) --}}
                                {{-- <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $finishedgoods->finished_good_number}}</td>
                                    <td>{{ $finishedgoods->row_material_issue _number}}</td>
                                    <td>{{ $finishedgoods->warehouse_code}}</td>
                                    <td>{{ $finishedgoods->pps_number}}</td>
                                    <td>{{ $finishedgoods->batch_number}}</td>
                                    <td>{{ $finishedgoods->plant_number}}</td>
                                    <td>{{ $finishedgoods->stock_number}}</td>
                                    <td>{{ $finishedgoods->serial_number}}</td>
                                    <td>{{ $finishedgoods->warehouse_code}}</td>
                                    <td>{{ $finishedgoods->issuing_quantity}}</td>
                                    <td>{{ $finishedgoods->product_quantity}}</td>
                                    <td>{{ $finishedgoods->production_weight}}</td>
                                    <td>{{ $finishedgoods->wastage_quantity}}</td>
                                    <td>{{ $finishedgoods->created_by}}</td>
                                    <td>{{ $finishedgoods->created_date}}</td>
                                    <td>{{ $finishedgoods->approved_by}}</td>
                                    <td>{{ $finishedgoods->approved_date}}</td>

                                    {{-- <td> --}}
                                        {{-- <a href="{{ route('finishedgoods.edit', $finishedgoods->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('finishedgoods.delete', $finishedgoods->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('finishedgoods.view', $finishedgoods->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i></a>
                                    </td> --}}
                                {{-- </tr>  --}}
                                {{-- @endforeach --}}
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
            $('#tbl_finishedgoods').DataTable();
        } );
    </script>
@endpush
