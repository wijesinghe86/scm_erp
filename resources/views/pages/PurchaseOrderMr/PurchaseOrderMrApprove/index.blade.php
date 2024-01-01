@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Purchase Order Approval Registry</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('purchase_order_approve.create') }}"
                                    class="btn btn-success float-end mb-2">
                                    Approve </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered data-table" id="po_table">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>PO No</td>
                                            <td>PR No</td>
                                            <td>Stock No</td>
                                            <td>Item</td>
                                            <td>U/M</td>
                                            <td>Quantity</td>
                                            <td>Created By</td> 
                                            <td>Status</td>
                                            <td>Approved By</td>
                                            <td>Approved Date</td>
                                            <td>Remark</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ optional(optional($item)->purchase_order)->po_no }}</td>
                                                <td>{{ optional(optional($item)->purchase_order->purchase_request_id)->mrfprf_no }}</td>
                                                <td>{{ optional(optional($item)->item)->stock_number }}</td>
                                                <td>{{ optional(optional($item)->item)->description }}</td>
                                                <td>{{ optional(optional($item)->item)->unit }}</td>
                                                <td>{{ $item->po_qty }}</td>
                                               <td>{{ $item->purchase_order->createUser->name }}</td> 
                                                <td>{{ $item->approval_status }}</td>
                                                <td>{{ optional(optional($item)->approvedBy)->name }}</td>
                                                <td>{{ $item->approval_status_changed_at }}</td>
                                                <td>{{ $item->remark }}</td>  
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
        // $(document).ready(function() {
        //     $('#pps_table').DataTable();
        // });
    </script>
@endpush
