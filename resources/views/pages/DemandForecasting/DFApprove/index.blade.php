@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Demand Forecasting Approval Registry</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('df_approve.create') }}" class="btn btn-success float-end mb-2"> Approve</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table bordered form-group">
                            <table class="table table-bordered" id="tbl_dfapprove">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td>Item No</td>
                                        <td>DF No</td>
                                        <td>Approved Qty</td>
                                        <td>Status</td>
                                        <td>Approved By</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $row)
                                        <tr>
                                            <td>{{ date('Y-m-d',strtotime($row->created_at))}}</td>
                                            <td>{{ $row->item->stock_number }}</td>
                                            <td>{{ $row->demand_forecast->df_no }}</td>
                                            <td>{{ $row->approved_qty }}</td>
                                            <td>{{ $row->action }}</td>
                                            <td>{{ $row->approved_by->name }}</td>
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
        $(document).ready(function() {
            // $('#tbl_dfapprove').DataTable();
        });
    </script>
@endpush
