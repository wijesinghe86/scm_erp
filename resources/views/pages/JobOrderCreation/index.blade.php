@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Job Order Report</h2>
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
                                        <a href="{{ route('jobordercreation.index') }}">
                                            <button class="btn btn-primary" type="button">Reset</button>
                                        </a>
                                    </form>
                                    <br>
                                    <br>
                                    <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('jobordercreation.create') }}" class="btn btn-success float-end mb-2"> Add
                                    New </a>
                                {{-- <a href="{{ route('jobordercreation.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table bordered form-group">
                                    <table class="table table-bordered" id="tbl_jobordercreation">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Job Order Number</td>
                                                <td>Job Order Date</td>
                                                <td>PPS Number</td>
                                                <td>Plant Number</td>
                                                <td>Created By</td>
                                                <td>Items</td>
                                                {{-- <td>Actions</td> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($job_orders as $job_order)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $job_order->job_order_no }}</td>
                                                    <td>{{ $job_order->jo_date }}</td>
                                                    <td>{{ $job_order->production_planing->pps_no }}</td>
                                                    <td>{{ $job_order->plant->plant_number }}</td>
                                                    <td>{{ $job_order->createdBy->name }}</td>
                                                    <td>
                                                        <table class="table table-striped">
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Stock Number</td>
                                                                <td>Description</td>
                                                                <td>Qty</td>
                                                                <td>Approval</td>
                                                            </tr>
                                                            @foreach ($job_order->items as $item)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $item->stock_item->stock_number }}</td>
                                                                    <td>{{ $item->stock_item->description }}</td>
                                                                    <td>{{ $item->jo_qty }}</td>
                                                                    <td>{{ $item->approval_status_changed_by ? $item->approval_status : '' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                 </table>
                                 {{ $job_orders->links('pagination::bootstrap-5') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    {{-- @push('scripts')
        <script>
            $(document).ready(function() {
                $('#tbl_jobordercreation').DataTable();
            });
        </script>
    @endpush --}}
