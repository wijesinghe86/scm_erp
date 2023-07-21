@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Dispatch List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('dispatch.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                                {{-- <a href="{{ route('dispatch.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
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
                                        <td>Items</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dispatches as $dispatch)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dispatch->dispatch_no }}</td>
                                            <td>{{ $dispatch->date }}</td>
                                            <td>{{ $dispatch->finished_good->fgrn_no }}</td>
                                            <td>{{ $dispatch->fleet->fleet_name }}</td>
                                            <td>{{ $dispatch->driver_name }}</td>
                                            <td>{{ $dispatch->dispatchedBy->employee_fullname }}</td>
                                            <td>{{ $dispatch->inspectedBy->employee_fullname }}</td>
                                            <td>
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Stock Number</td>
                                                        <td>Description</td>
                                                        <td>Qty</td>
                                                    </tr>
                                                    @foreach ($dispatch->items as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ optional(optional($item)->stock_item)->stock_number }}
                                                            </td>
                                                            <td>{{ optional(optional($item)->stock_item)->description }}
                                                            </td>
                                                            <td>{{ $item->qty }}</td>
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
            $('#tbl_dispatch').DataTable();
        });
    </script>
@endpush
