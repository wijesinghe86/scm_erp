@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Job Order Approval Registry
                            </h4>
                            <br>
                            <br>
                            <div class ="container">
                                <div class="row m-2">
                                    <form action="" class="col-9">
                                        <div class="form-group">
                                            <input type="text" name="search" id="" class="form-control"
                                                placeholder="Search by Job_Order_No / DF No / Job_Order_Date / Stock Number "
                                                value="{{ request('search') }}">
                                        </div>
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ route('joborderapproval.index') }}">
                                            <button class="btn btn-primary" type="button">Reset</button>
                                        </a>
                                    </form>
                                    <br>
                                    <br>
                                    <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('joborderapproval.create') }}" class="btn btn-success float-end mb-2">
                                    Approve </a>
                            </div>
                            <div class="table-responsive" >
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <td>#</td>
                                        <td>Job Order Number</td>
                                        <td>Job Order Date</td>
                                        <td>Stock Number</td>
                                        <td>PPS Number</td>
                                        <td>Plant Number</td>
                                        <td>Job Order Quantity</td>
                                        <td>Created By</td>
                                        <td>Status</td>
                                        <td>Remark</td>
                                        <td>Approved By</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ optional($item->job_order)->job_order_no }}</td>
                                                <td>{{ optional($item->job_order)->jo_date }}</td>
                                                <td>{{ optional($item->stock_item)->stock_number }}</td>
                                                <td>{{ optional($item->production_planing)->pps_no }}</td>
                                                <td>{{ optional(optional($item->job_order)->plant)->plant_number }}</td>
                                                <td>{{ $item->jo_qty }}</td>
                                                <td>{{ optional($item->createdBy)->name }}</td>
                                                <td>{{ $item->approval_status }}</td>
                                                <td>{{ $item->approval_remark }}</td>
                                                <td>{{ optional($item->approvedBy)->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        {{ $list->links('pagination::bootstrap-5') }}
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
