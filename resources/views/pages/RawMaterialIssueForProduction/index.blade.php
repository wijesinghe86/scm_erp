@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Raw Material Issue For Production List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('rawmaterialissueforproduction.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('rawmaterialissueforproduction.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_rawmaterialissueforproduction">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Issue Document Number</td>
                                    <td>Date</td>
                                    <td>Warehouse Code</td>
                                    {{-- <td>Plant Number</td> --}}
                                    <td>Job Order Number</td>
                                    {{-- <td>PPS Number</td> --}}
                                    <td>Stock Number</td>
                                    {{-- <td>Semi Product Number</td> --}}
                                    <td>Serial Number</td>
                                    {{-- <td>Issue Quantity By Serial</td>
                                    <td>Issued Weight By Serial</td>
                                    <td>Total Issue Quantity</td>
                                    <td>Total Weight</td>
                                    <td>Issued By</td>
                                    <td>Issued Date</td>
                                    <td>Approved By</td>
                                    <td>Approved Date</td> --}}
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($rawmaterialissueforproductions as $rawmaterialissueforproduction)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $rawmaterialissueforproduction->issue_document_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->date}}</td>
                                    <td>{{ $rawmaterialissueforproduction->warehouse_code}}</td>
                                    <td>{{ $rawmaterialissueforproduction->plant_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->job_order_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->pps_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->stock_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->semi_product_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->serial_number}}</td>
                                    <td>{{ $rawmaterialissueforproduction->issue_quantity_by_serial}}</td>
                                    <td>{{ $rawmaterialissueforproduction->issued_weight_by_serial}}</td>
                                    <td>{{ $rawmaterialissueforproduction->total_issue_quantity}}</td>
                                    <td>{{ $rawmaterialissueforproduction->total_weight}}</td>
                                    <td>{{ $rawmaterialissueforproduction->issued_by}}</td>
                                    <td>{{ $rawmaterialissueforproduction->issued_date}}</td>
                                    <td>{{ $rawmaterialissueforproduction->approved_by}}</td>
                                    <td>{{ $rawmaterialissueforproduction->approved_date}}</td>
                                    <td>
                                        <a href="{{ route('rawmaterialissueforproduction.edit', $rawmaterialissueforproduction->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('rawmaterialissueforproduction.delete', $rawmaterialissueforproduction->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('rawmaterialissueforproduction.view', $rawmaterialissueforproduction->id) }}">
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
            $('#tbl_rawmaterialissueforproduction').DataTable();
        } );
    </script>
@endpush
