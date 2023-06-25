@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Production Planning And
                            Schedule Approval Registry</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('production_planning_and_schedule_approval.create') }}"
                                    class="btn btn-success float-end mb-2">
                                    Approve </a>
                            </div>
                            <table class="table table-bordered" id="pps_table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>PPS No</td>
                                        <td>DF No</td>
                                        <td>Item</td>
                                        <td>Quantity</td>
                                        <td>Created By</td>
                                        <td>Status</td>
                                        <td>Approved By</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->production_planing->pps_no }}</td>
                                            <td>{{ $item->demand_forecasting->df_no }}</td>
                                            <td>{{ $item->stock_item->description}}</td>
                                            <td>{{ $item->pps_qty }}</td>
                                            <td>{{ $item->createdBy->name }}</td>
                                            <td>{{ $item->approval_status }}</td>
                                            <td>{{ $item->approvedBy->name }}</td>
                                        </tr>
                                    @endforeach
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
        // $(document).ready(function() {
        //     $('#pps_table').DataTable();
        // });
    </script>
@endpush
