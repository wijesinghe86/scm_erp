@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Dispatch Approval List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_dispatch">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Dispatch Number</td>
                                            <td>Dispatched Date</td>
                                            <td>FGRN No</td>
                                            <td>Fleet</td>
                                            <td>Driver Name</td>
                                            <td>Dispatched By</td>
                                            <td>Inspected By</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dispatch_list as $dispatch)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $dispatch->dispatch_no }}</td>
                                                <td>{{ $dispatch->date }}</td>
                                                <td>{{ $dispatch->finished_good->fgrn_no }}</td>
                                                <td>{{ $dispatch->fleet->fleet_name }}</td>
                                                <td>{{ $dispatch->driver_name }}</td>
                                                <td>{{ $dispatch->dispatchedBy->employee_fullname }}</td>
                                                <td>{{ $dispatch->inspectedBy->employee_fullname }}</td>
                                                {{-- @if (count($dispatch->items) > 0) --}}
                                                <td>
                                                    <a href="{{ route('dispatch_approval.create', $dispatch->id) }}"
                                                        class="btn btn-primary">View</a>
                                                </td>
                                                {{-- @endif --}}
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
