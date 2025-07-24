@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="header">
                        <h4 class="title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Production Planning and
                            Schedule Catalogue</h2>
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
                                        <a href="{{ route('productionplanningandschedule.index') }}">
                                            <button class="btn btn-primary" type="button">Reset</button>
                                        </a>
                                    </form>
                                    <br>
                                    <br>
                                    <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('productionplanningandschedule.create') }}"
                                    class="btn btn-success float-end mb-2"> Add New </a>
                                {{-- <a href="{{ route('productionplanningandschedule.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_productionplanningandschedule">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>PPS Number</td>
                                            <td>PPS Date</td>
                                            <td>DF Number</td>
                                            <td>Production Start Date</td>
                                            <td>Production End Date</td>
                                            <td>Items</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productionplanningandschedules as $productionplanningandschedule)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $productionplanningandschedule->pps_no }}</td>
                                                <td>{{ $productionplanningandschedule->pps_date }}</td>
                                                <td>{{ optional(optional($productionplanningandschedule)->demand_forecasting)->df_no}}</td>
                                                <td>{{ $productionplanningandschedule->start_date }}</td>
                                                <td>{{ $productionplanningandschedule->end_date }}</td>
                                                <td>
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td>#</td>
                                                            <td>Stock Number</td>
                                                            <td>Description</td>
                                                            <td>Qty</td>
                                                            <td>Weight</td>
                                                            <td>Approval</td>
                                                        </tr>
                                                        @foreach ($productionplanningandschedule->items as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->stock_item->stock_number }}</td>
                                                                <td>{{ $item->stock_item->description }}</td>
                                                                <td>{{ $item->pps_qty }}</td>
                                                                <td>{{ $item->weight }}</td>
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
                                {{ $productionplanningandschedules->links('pagination::bootstrap-5') }}
                        </div>
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
            $('#tbl_productionplanningandschedule').DataTable();
        });
    </script>
@endpush --}}
