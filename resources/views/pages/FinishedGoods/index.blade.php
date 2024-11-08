@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Finished Goods List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('finishedgoods.create') }}" class="btn btn-success float-end mb-2"> Add New
                                </a>
                                {{-- <a href="{{ route('finishedgoods.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_finishedgoods">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Finished Goods Number</td>
                                            <td>Raw Material Issue Number</td>
                                            <td>Warehouse</td>
                                            <td>Tot Issue Weight</td>
                                            <td>Tot Pro Weight</td>
                                            <td>Tot Wastage</td>
                                            <td>Remaining Qty</td>
                                            <td>Prod Start Date</td>
                                            <td>Prod End Date</td>
                                            <td>Status</td>
                                            <td>Created By</td>
                                            <td>View</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fgrns as $fgrn)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $fgrn->fgrn_no }}</td>
                                                <td>{{ $fgrn->rmi->rmi_no }}</td>
                                                <td>{{ optional(optional($fgrn)->warehouse)->warehouse_name }}</td>
                                                <td>{{ $fgrn->tot_issue_weight }}</td>
                                                <td>{{ $fgrn->tot_pro_weight }}</td>
                                                <td>{{ $fgrn->tot_wastage }}</td>
                                                <td>{{ $fgrn->remaining_qty }}</td>
                                                <td>{{ $fgrn->pro_start_date_time }}</td>
                                                <td>{{ $fgrn->pro_end_date_time }}</td>
                                                <td>{{ $fgrn->status }}</td>
                                                <td>{{ optional(optional($fgrn)->createdBy)->name }}</td>
                                                <td>
                                                    <a href="{{ route('finishedgoods.view', $fgrn->id) }}"
                                                        class="btn btn-primary"> View More </a>
                                                </td>
                                                    {{-- <table class="table table-striped">

                                                        <tr>
                                                            <td>#</td>
                                                            <td>Stock Number</td>
                                                            <td>Description</td>
                                                            <td>Qty</td>
                                                            <td>Batch</td>
                                                        </tr>
                                                        @foreach ($fgrn_items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                               <td>{{ optional(optional($item)->stock_item_by_stockNumber)->stock_number }}</td>
                                                                <td>{{optional(optional($item)->stock_item_by_stockNumber)->description }}</td>
                                                                <td>{{ $item->pro_qty }}</td>
                                                                <td>{{ $item->batch_no }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td> --}}
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
            $('#tbl_finishedgoods').DataTable();
        });
    </script>
@endpush
