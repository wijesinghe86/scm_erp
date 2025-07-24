@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Production Planning And
                            Schedule Approval Registry</h2>
                            <br>
                            <br>
                            <div class ="container">
                                <div class="row m-2">
                                    <form action="" class="col-9">
                                        <div class="form-group">
                                            <input type="text" name="search" id="" class="form-control"
                                                placeholder="Search by PPS No / PPS Date / DF No / Stock Number "
                                                value="{{ request('search') }}">
                                        </div>
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{ route('production_planning_and_schedule_approval.index') }}">
                                            <button class="btn btn-primary" type="button">Reset</button>
                                        </a>
                                    </form>
                                    <br>
                                    <br>
                                    <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('production_planning_and_schedule_approval.create') }}"
                                    class="btn btn-success float-end mb-2">
                                    Approve </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered data-table" id="pps_table">
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
                                            <td>Remark</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ optional(optional($item)->production_planing)->pps_no }}</td>
                                                <td>{{ optional(optional($item)->demand_forecasting)->df_no }}</td>
                                                <td>{{ optional(optional($item)->stock_item)->description }}</td>
                                                <td>{{ $item->pps_qty }}</td>
                                                <td>{{ $item->createdBy->name }}</td>
                                                <td>{{ $item->approval_status }}</td>
                                                <td>{{ optional(optional($item)->approvedBy)->name }}</td>
                                                <td>{{ $item->remark }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$list->links('pagination::bootstrap-5')  }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            $('#pps_table').DataTable();
        });
    </script>
@endpush --}}
