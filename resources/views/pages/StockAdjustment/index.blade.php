@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Stock Adjustment Catalogue</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('stockadjustment.create') }}" class="btn btn-success float-end mb-2"> Add
                                    New </a>
                                {{-- <a href="{{ route('stockadjustment.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <table class="table table-bordered" id="tbl_stockadjustment">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Stock Adjustment Number</td>
                                        <td>Stock Adjustment Date</td>
                                        <td>Type</td>
                                        <td>Created By</td>
                                        <td>Created Date</td>
                                        <td>Approved By</td>
                                        <td>Approved Date</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock_adjustments as $stockadjustment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $stockadjustment->stock_adjustment_number }}</td>
                                            <td>{{ $stockadjustment->date }}</td>
                                            <td>{{ $stockadjustment->type }}</td>
                                            <td>{{ $stockadjustment->createdBy->employee_fullname }}</td>
                                            <td>{{ date('Y-m-d', strtotime($stockadjustment->created_at)) }}</td>
                                            <td>{{ optional(optional($stockadjustment)->approvedBy)->employee_fullname }}</td>
                                            <td>{{ $stockadjustment->approved_at }}</td>
                                            <td>{{ $stockadjustment->approved_status }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('stockadjustment.approvalIndex', $stockadjustment->id) }}">
                                                    <i class="mdi mdi-eye text-dark"></i>
                                                </a>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tbl_stockadjustment').DataTable();
        });
    </script>
@endpush
