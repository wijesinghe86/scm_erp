@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Stock Item List</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('stockitem.all') }}" class="btn btn-primary float-end mb-2"> Stock Item List</a>
                            </div>

                            <table class="table table-bordered" id="tbl_stockitem">

                                <thead>
                                    <tr>
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
                                        <td>Deleted By</td>
                                        <td>Deleted AT</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($stockitems as $stockitem)
                                        <tr>
                                            <td>{{ $stockitem->stock_number }}</td>
                                            <td>{{ $stockitem->description }}</td>
                                            <td>{{ $stockitem->unit }}</td>
                                            <td>{{ $stockitem->cost_price }}</td>
                                            <!-- <td>{{ $stockitem->barcode }}</td>
                                            <td>{{ $stockitem->keyword }}</td>
                                            <td>{{ $stockitem->group }}</td>
                                            <td>{{ $stockitem->class }}</td>
                                            <td>{{ $stockitem->serial_number }}</td>
                                            <td>{{ $stockitem->part_number }}</td>
                                            <td>{{ $stockitem->model }}</td>
                                            <td>{{ $stockitem->make }}</td>
                                            <td>{{ $stockitem->minimum_qty }}</td>
                                            <td>{{ $stockitem->maximum_qty }}</td>
                                            <td>{{ $stockitem->re_order_level }}</td>
                                            <td>{{ $stockitem->substitute_stock_number }}</td>
                                            <td>{{ $stockitem->enduser }}</td>
                                            <td>{{ $stockitem->stock_item_Grade }}</td>
                                            <td>{{ $stockitem->stock_item_chem_c }}</td>
                                            <td>{{ $stockitem->stock_item_chem_mn }}</td>
                                            <td>{{ $stockitem->stock_item_mech_ys }}</td>
                                            <td>{{ $stockitem->stock_item_mech_ts }}</td>
                                            <td>{{ $stockitem->stock_item_mech_ei }}</td>
                                            <td>{{ $stockitem->stock_item_physical_weight }}</td>
                                            <td>{{ $stockitem->stock_item_physical_width }}</td>
                                            <td>{{ $stockitem->stock_item_physical_thickness }}</td>
                                            <td>{{ $stockitem->stock_item_date_of_mfr }}</td>
                                            <td>{{ $stockitem->stock_item_date_of_expiry }}</td>
                                            <td>{{ $stockitem->stock_item_special_ins }}</td>
                                            <td>{{ $stockitem->stock_item_storage_method }}</td>
                                            <td>{{ $stockitem->stock_item_handling_method }}</td>
                                            <td>{{ $stockitem->stock_item_inspection_reuired }}</td> -->
                                            <td>{{ $stockitem->deleteUser?$stockitem->deleteUser->name : 'User not found' }}</td>
                                            <td>{{ $stockitem->deleted_at }}</td>
                                            {{-- <td>
                                                <a href="{{ route('stockitem.restore', $stockitem->id) }}">
                                                    <i class="mdi mdi-pencil text-dark"></i>
                                                </a>

                                                <a href="{{ route('stockitem.delete.force', $stockitem->id) }}">
                                                    <i class="mdi mdi-delete text-danger"></i></a>
                                            <td> --}}

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
