@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Production Wastage List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('productionwastage.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('productionwastage.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_productionwastage">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Finished Good Number</td>
                                    <td>Row Material Issue Number</td>
                                    <td>Stock Number</td>
                                    <td>Quantity</td>
                                    <td>Weight</td>
                                    {{-- <td>Batch Number</td>
                                    <td>Semi Row Material Serial Range</td>
                                    <td>Warehouse Code</td>
                                    <td>Date</td>
                                    <td>Job Order</td>
                                    <td>Created By</td>
                                    <td>Create Date</td>
                                    <td>Approved By</td>
                                    <td>Approved Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($productionwastages as $productionwastage)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $productionwastage->finished_good_number}}</td>
                                    <td>{{ $productionwastage->row_material_issue_number}}</td>
                                    <td>{{ $productionwastage->stock_number}}</td>
                                    <td>{{ $productionwastage->quantity}}</td>
                                    <td>{{ $productionwastage->weight}}</td>
                                    <td>{{ $productionwastage->batch_number}}</td>
                                    <td>{{ $productionwastage->semi_row_materialSerial_range}}</td>
                                    <td>{{ $productionwastage->warehouse_code}}</td>
                                    <td>{{ $productionwastage->date}}</td>
                                    <td>{{ $productionwastage->job_order}}</td>
                                    <td>{{ $productionwastage->created_by}}</td>
                                    <td>{{ $productionwastage->create_date}}</td>
                                    <td>{{ $productionwastage->approved_by}}</td>
                                    <td>{{ $productionwastage->approved_date}}</td>

                                    <td>
                                        <a href="{{ route('productionwastage.edit', $productionwastage->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('productionwastage.delete', $productionwastage->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('productionwastage.view', $productionwastage->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i></a>
                                    </td>
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
            $('#tbl_productionwastage').DataTable();
        } );
    </script>
@endpush
