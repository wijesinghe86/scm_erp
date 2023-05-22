@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Goods Received List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('goodsreceived.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('goodsreceived.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a></div> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_goodsreceived">
                            <thead>
                                <tr>
                                    <tr>
                                        <td>No</td>
                                        <td>Supplier Code</td>
                                        <td>Purchase Order Number</td>
                                        {{-- <td>Batch Number</td> --}}
                                        <td>Goods Received Number</td>
                                        <td>Goods Received Date</td>
                                        {{-- <td>Goods Received Type</td>
                                        <td>Warehouse Code</td> --}}
                                        <td>Stock Number</td>
                                        {{-- <td>Expire Date</td>
                                        <td>Purchase Order Quantity</td>
                                        <td>Received Quantity</td>
                                        <td>Received Date</td>
                                        <td>Over Shortage Damage Report Number</td>
                                        <td>Weight Per Unit</td>
                                        <td>Total Weight</td>
                                        <td>Volume Per Unit</td>
                                        <td>Total Volume</td>
                                        <td>Received By</td>
                                        <td>Received Date</td>
                                        <td>Inspected By</td>
                                        <td>Inspected Date</td>
                                        <td>Verified By</td>
                                        <td>Verified Date</td>
                                        <td>Approved By</td>
                                        <td>Approved Date</td> --}}
                                        <td>Action</td>
                                    </tr>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($goodsreceiveds as $goodsreceived)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $goodsreceived->supplier_code}}</td>
                                    <td>{{ $goodsreceived->po_number }}</td>
                                    <td>{{ $goodsreceived->batch_number }}</td>
                                    <td>{{ $goodsreceived->grn_number }}</td>
                                    <td>{{ $goodsreceived->grn_date}}</td>
                                    <td>{{ $goodsreceived->type_of_received }}</td>
                                    <td>{{ $goodsreceived->warehouse_code }}</td>
                                    <td>{{ $goodsreceived->stock_number}}</td>
                                    <td>{{ $goodsreceived->expire_date }}</td>
                                    <td>{{ $goodsreceived->po_quantity}}</td>
                                    <td>{{ $goodsreceived->received_quantity }}</td>
                                    <td>{{ $goodsreceived->received_date }}</td>
                                    <td>{{ $goodsreceived->over_shortage_damage_report_number }}</td>
                                    <td>{{ $goodsreceived->weight_per_unit}}</td>
                                    <td>{{ $goodsreceived->total_weight }}</td>
                                    <td>{{ $goodsreceived->volume_per_unit }}</td>
                                    <td>{{ $goodsreceived->total_volume}}</td>
                                    <td>{{ $goodsreceived->received_by }}</td>
                                    <td>{{ $goodsreceived->received_date }}</td>
                                    <td>{{ $goodsreceived->inspected_by}}</td>
                                    <td>{{ $goodsreceived->inspected_date }}</td>
                                    <td>{{ $goodsreceived->verified_by }}</td>
                                    <td>{{ $goodsreceived->verified_date }}</td>
                                    <td>{{ $goodsreceived->approved_by}}</td>
                                    <td>{{ $goodsreceived->approved_date }}</td> -->


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
                $('#tbl_goodsreceived').DataTable();
            } );
        </script>
    @endpush
