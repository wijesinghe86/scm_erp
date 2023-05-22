@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Dispatch List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('dispatch.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('dispatch.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_dispatch">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Dispatch Number</td>
                                    <td>Dispatched Date</td>
                                    <td>Batch Number</td>
                                    <td>From Location</td>
                                    <td>To Location</td>
                                    {{-- <td>Stock Number</td>
                                    <td>Finished Goods Number</td>
                                    <td>Finish Goods Serial Range</td>
                                    <td>Each Quantity</td>
                                    <td>Each Weight</td>
                                    <td>Total Quantity</td>
                                    <td>Total Weight</td>
                                    <td>Remarks</td>
                                    <td>Dispatched By</td>
                                    <td>Dispatched Date</td>
                                    <td>Inspected By</td>
                                    <td>Inspected Date</td>
                                    <td>Approved By</td>
                                    <td>Approved Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($dispatchs as $dispatch)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $dispatch->dispatch_number}}</td>
                                    <td>{{ $dispatch->dispatched_date}}</td>
                                    <td>{{ $dispatch->batch_number}}</td>
                                    <td>{{ $dispatch->from_location}}</td>
                                    <td>{{ $dispatch->to_location}}</td>
                                    <td>{{ $dispatch->stock_number}}</td>
                                    <td>{{ $dispatch->finished_goods_number}}</td>
                                    <td>{{ $dispatch->finish_goods_serial_range}}</td>
                                    <td>{{ $dispatch->each_quantity}}</td>
                                    <td>{{ $dispatch->each_weight}}</td>
                                    <td>{{ $dispatch->total_quantity}}</td>
                                    <td>{{ $dispatch->total_weight}}</td>
                                    <td>{{ $dispatch->remarks}}</td>
                                    <td>{{ $dispatch->dispatched_by}}</td>
                                    <td>{{ $dispatch->dispatched_date}}</td>
                                    <td>{{ $dispatch->inspected_by}}</td>
                                    <td>{{ $dispatch->inspected_date}}</td>
                                    <td>{{ $dispatch->approved_by}}</td>
                                    <td>{{ $dispatch->approved_date}}</td>


                                    <td>
                                        <a href="{{ route('dispatch.edit', $dispatch->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('dispatch.delete', $dispatch->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('dispatch.view', $dispatch->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody> --}}

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_dispatch').DataTable();
        } );
    </script>
@endpush
