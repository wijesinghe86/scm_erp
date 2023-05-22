@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Stock Adjustment Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('stockadjustment.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('stockadjustment.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_stockadjustment">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Stock Adjustment Number</td>
                                    <td>Stock Adjustment Date</td>
                                    {{-- <td>Type</td> --}}
                                    <td>From Stock Number</td>
                                    <td>Transfer To Stock Number</td>
                                    {{-- <td>Quantity</td>
                                    <td>Weight</td>
                                    <td>Transfered Warehouse Code</td> --}}
                                    <td>Justification</td>
                                    {{-- <td>Created By</td>
                                    <td>Created Date</td>
                                    <td>Approved By</td>
                                    <td>Approved Date</td> --}}
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($stockadjustments as $stockadjustment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $stockadjustment->stock_adjustment_number}}</td>
                                    <td>{{ $stockadjustment->stock_adjustment_date}}</td>
                                    <td>{{ $stockadjustment->type}}</td>
                                    <td>{{ $stockadjustment->from_stock_number}}</td>
                                    <td>{{ $stockadjustment->transfer_to_stock_number}}</td>
                                    <td>{{ $stockadjustment->quantity}}</td>
                                    <td>{{ $stockadjustment->weight}}</td>
                                    <td>{{ $stockadjustment->transfered_warehouse_code}}</td>
                                    <td>{{ $stockadjustment->justification}}</td>
                                    <td>{{ $stockadjustment->created_by}}</td>
                                    <td>{{ $stockadjustment->created_date}}</td>
                                    <td>{{ $stockadjustment->approved_by}}</td>
                                    <td>{{ $stockadjustment->approved_date}}</td>

                                     <td>
                                        <a href="{{ route('stockadjustment.edit', $stockadjustment->id) }}">
                                        <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('stockadjustment.delete', $stockadjustment->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </a>

                                        <a href="{{ route('stockadjustment.view', $stockadjustment->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i>
                                        </a>
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
            $('#tbl_stockadjustment').DataTable();
        } );
    </script>
@endpush
