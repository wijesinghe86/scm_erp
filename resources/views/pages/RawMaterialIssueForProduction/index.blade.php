@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Raw Material Issue For Production List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('rawmaterialissueforproduction.create') }}"
                                    class="btn btn-success float-end mb-2"> Add New </a>
                            </div>
                            <div class="table-responsive" >
                                <table class="table table-bordered data-table" id="tbl_rawmaterialissueforproduction">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>RMR No</td>
                                            <td>RMI No</td>
                                            <td>Requested Item</td>
                                            <td>Issued Serial No</td>
                                            <td>Qty</td>
                                            <td>Weight</td>
                                            <td>Remark</td>
                                            <td>Location</td>
                                            <td>Issued by</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->raw_material_issue->raw_material_request->rmr_no }}</td>
                                                <td>{{ $item->rmi_no }}</td>
                                                <td>{{ $item->raw_material_request_item->stock_item->stock_number }}</td>
                                                <td>{{ $item->semi_product_serial_no }}</td>
                                                <td>{{ $item->semi_product_qty }}</td>
                                                <td>{{ $item->semi_product_weight }}</td>
                                                <td>{{ $item->remarks }}</td>
                                                <td>{{ $item->raw_material_issue->warehouse->warehouse_name }}</td>
                                                <td>{{ $item->raw_material_issue->createdBy->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
