@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Raw Material Reviced For Production List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('rawmaterial_received_for_production.create') }}"
                                    class="btn btn-success float-end mb-2"> Add New </a>
                            </div>
                            <div class="table-responsive" >
                                <table class="table table-bordered" id="tbl_rawmaterialissueforproduction">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>RMA No</td>
                                            <td>RMI No</td>
                                            <td>Warehouse</td>
                                            <td>Received By</td>
                                            <td>Items</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $row)
                                            <tr>
                                                <td class="align-top">{{ $loop->iteration }}</td>
                                                <td class="align-top">{{ $row->rma_no }}</td>
                                                <td class="align-top">{{ $row->rmi_no }}</td>
                                                <td class="align-top">{{ $row->warehouse->warehouse_name }}</td>
                                                <td class="align-top">{{ $row->receivedBy->employee_fullname }}</td>
                                                <td>
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Item</th>
                                                            <th>Serial No</th>
                                                            <th>Qty</th>
                                                            <th>Remark</th>
                                                        </tr>
                                                        @foreach ($row->items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->stock_item->stock_number }}</td>
                                                                <td>{{ $item->serial_no }}</td>
                                                                <td>{{ $item->received_qty }}</td>
                                                                <td>{{ $item->remarks }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
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
