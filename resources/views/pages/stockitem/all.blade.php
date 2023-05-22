@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>  Stock Item Catalogue</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('stockitem.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                            <a href="{{ route('stockitem.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                        </div>

                            <table class="table table-bordered" id="tbl_stockitem">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Stock Number</td>
                                        <td>Descritption</td>
                                        <td>Unit</td>
                                        <td>Cost Price</td>
                                        <!-- <td>Barcode</td>
                                        <td>Keyword</td>
                                        <td>Group</td>
                                        <td>Class</td>
                                        <td>Serial Number</td>
                                        <td>Part Number</td>
                                        <td>Model</td>
                                        <td>Make</td>
                                        <td>Substitute Item</td>
                                        <td>End User</td>
                                        <td>stock item Grade</td>
                                        <td>Chemical C</td>
                                        <td>Chemical Mn</td>
                                        <td>Mechanical Ys</td>
                                        <td>Mechanical Ts</td>
                                        <td>Mechanical Ei</td>
                                        <td>Physical Weight</td>
                                        <td>Physical Width</td>
                                        <td>Physical Thickness</td>
                                        <td>Date of Manufactor</td>
                                        <td>Date of Expiry</td>
                                        <td>Minimum Quantity</td>
                                        <td>Maximum Quantity</td>
                                        <td>Re-Order Level</td>
                                        <td>Special Instructions</td>
                                        <td>Storage Method</td>
                                        <td>Handling Method</td>
                                        <td>Inspection Required Status</td> -->
                                        <td>Created By</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($stockitems as $StockItem)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $StockItem->stock_number }}</td>
                                            <td>{{ $StockItem->description }}</td>
                                            <td>{{ $StockItem->unit }}</td>
                                            <td>{{ $StockItem->cost_price }}</td>
                                            {{-- <td>{{ $StockItem->barcode }}</td>
                                            <td>{{ $StockItem->keyword }}</td>
                                            <td>{{ $StockItem->group }}</td>
                                            <td>{{ $StockItem->class }}</td>
                                            <td>{{ $StockItem->serial_number }}</td>
                                            <td>{{ $StockItem->part_number }}</td>
                                            <td>{{ $StockItem->model }}</td>
                                            <td>{{ $StockItem->make }}</td>
                                            <td>{{ $StockItem->minimum_qty }}</td>
                                            <td>{{ $StockItem->maximum_qty }}</td>
                                            <td>{{ $StockItem->re_order_level }}</td>
                                            <td>{{ $StockItem->substitute_stock_number }}</td>
                                            <td>{{ $StockItem->enduser }}</td>
                                            <td>{{ $StockItem->stock_item_Grade }}</td>
                                            <td>{{ $StockItem->stock_item_chem_c }}</td>
                                            <td>{{ $StockItem->stock_item_chem_mn }}</td>
                                            <td>{{ $StockItem->stock_item_mech_ys }}</td>
                                            <td>{{ $StockItem->stock_item_mech_ts }}</td>
                                            <td>{{ $StockItem->stock_item_mech_ei }}</td>
                                            <td>{{ $StockItem->stock_item_physical_weight }}</td>
                                            <td>{{ $StockItem->stock_item_physical_width }}</td>
                                            <td>{{ $StockItem->stock_item_physical_thickness }}</td>
                                            <td>{{ $StockItem->stock_item_date_of_mfr }}</td>
                                            <td>{{ $StockItem->stock_item_date_of_expiry }}</td>
                                            <td>{{ $StockItem->stock_item_special_ins }}</td>
                                            <td>{{ $StockItem->stock_item_storage_method }}</td>
                                            <td>{{ $StockItem->stock_item_handling_method }}</td>
                                            <td>{{ $StockItem->stock_item_inspection_reuired }}</td> --}}
                                            {{-- <td>{{ $StockItem->created_by }}</td> --}}
                                            <td>{{ $StockItem->createUser ? $StockItem->createUser->name : 'User not found' }}</td>

                                            <td>
                                                @if ($StockItem->stockItem_status == 1)
                                                    <a href="{{ route('stockitem.deactive', $StockItem->id) }}"
                                                        class="btn btn-primary btn-sm">Deactive</a>
                                                @else
                                                    <a href="{{ route('stockitem.active', $StockItem->id) }}"
                                                        class="btn btn-success btn-sm">Active</a>
                                                @endif
                                            </td>

                                            <td align="right" >
                                                <a class="h4" href="{{ route('stockitem.view', $StockItem->id) }}">
                                                    <i  class="fa-sharp fa-solid fa-eye"></i>
                                                </a>

                                                <a class="h4" href="{{ route('stockitem.edit', $StockItem->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <a class="h4" href="{{ route('stockitem.delete', $StockItem->id) }}">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
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
        $(document).ready( function () {
            $('#tbl_stockitem').DataTable();
        } );
    </script>
@endpush
