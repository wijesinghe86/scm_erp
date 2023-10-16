@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Raw Material Request Registry
                            </h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('raw_material_request.create') }}" class="btn btn-success float-end mb-2">
                                    Add New </a>
                                {{-- <a href="{{ route('warehouse.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div class="table-responsive" >
                                <table class="table table-bordered" id="tbl_raw_materialrequest">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Request Date</td>
                                            <td>JO No</td>
                                            <td>RMR No</td>
                                            <td>Requested by</td>
                                            <td>Items</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $materialrequest)
                                            <tr>
                                                <td class="align-top">{{ $loop->iteration }}</td>
                                                <td class="align-top">{{ $materialrequest->req_date }}</td>
                                                <td class="align-top">{{ $materialrequest->job_order->job_order_no }}</td>
                                                <td class="align-top">{{ $materialrequest->rmr_no }}</td>
                                                <td class="align-top">
                                                    {{ $materialrequest->requested_by ? $materialrequest->requestedBy->employee_fullname : 'User not found' }}
                                                </td>
                                                <td>
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Jo S/No</th>
                                                            <th scope="col">Jo Description</th>
                                                            <th scope="col">Jo Qty</th>
                                                            <th scope="col">Rmr items</th>
                                                        </tr>
                                                        @foreach ($materialrequest->items->groupBy('jo_stock_no') as $key => $material_request_items)
                                                            <tr>
                                                                <td class="align-top">{{ $loop->iteration }}</td>
                                                                <td class="align-top">
                                                                    {{ $material_request_items[0]['job_order_item']['stock_item']['stock_number'] }}
                                                                </td>
                                                                <td class="align-top">
                                                                    {{ $material_request_items[0]['job_order_item']['stock_item']['description'] }}
                                                                </td>
                                                                <td class="align-top">
                                                                    {{ $material_request_items[0]['job_order_item']['jo_qty'] }}
                                                                </td>
                                                                <td>
                                                                    <table class="table table-striped">
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Rmr S/No</th>
                                                                            <th scope="col">Rmr Descrition</th>
                                                                            <th scope="col">Rmr Qty</th>
                                                                            <th scope="col">Rmr Weight</th>
                                                                        </tr>
                                                                        @foreach ($material_request_items as $material_request_item)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $material_request_item->stock_item->stock_number }}
                                                                                </td>
                                                                                <td>{{ $material_request_item->stock_item->description }}
                                                                                </td>
                                                                                <td>{{ $material_request_item->req_qty }}
                                                                                </td>
                                                                                <td>{{ $material_request_item->req_weight }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </td>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_raw_materialrequest').DataTable();
        });
    </script>
@endpush
