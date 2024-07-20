@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Semi Goods Report</h2>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('semiproduction.create') }}" class="btn btn-success float-end mb-2"> Add New
                                </a>
                                {{-- <a href="{{ route('semiproduction.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                            </div>
                            <div style="overflow: scroll">
                                <table class="table table-bordered" id="tbl_semiproduction">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Semi Product Number</td>
                                            <td>Goods Receiving Number</td>
                                            <td>Stock Number</td>
                                            <td>Description</td>
                                            <td>Serial Number</td>
                                            <td>Semi Product Serial Numbers</td>
                                            <td>Semi Product Description | Stock Number</td>
                                            <td>Qty</td>
                                            <td>Weight</td>
                                            <td>Plant Number</td>
                                            <td>Warehouse Code</td>
                                            {{-- <td>Actual Raw Material Serial Weight</td>
                                            <td>Semi Product Weight</td> --}}
                                            <td>Date</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semi_productions as $semi_production)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $semi_production->semi_pro_No }}</td>
                                                <td>{{ $semi_production->grn_no }}</td>
                                                <td>{{ $semi_production->raw_material_stock_item->stock_number }}</td>
                                                <td>{{ $semi_production->raw_material_stock_item->description }}</td>
                                                <td>{{ $semi_production->raw_material_serial_item->serial_no }}</td>
                                                <td>
                                                    @foreach ($semi_production->semi_product_items->pluck('semi_pro_serial_no') as $semi_pro_serial_no)
                                                        <div>{{ $semi_pro_serial_no }}</div><br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($semi_production->semi_product_items as $semiProductItem)
                                                        <div>{{ $semiProductItem->semi_product_stock_item->description }} |
                                                            {{ $semiProductItem->semi_product_stock_item->stock_number }}
                                                        </div><br>
                                                    @endforeach
                                                    <div><b>TOTAL</b></div>
                                                </td>
                                                <td>
                                                    @foreach ($semi_production->semi_product_items->pluck('semi_pro_qty') as $semi_pro_qty)
                                                        <div>{{ $semi_pro_qty }}</div><br>
                                                    @endforeach
                                                    <div><b>{{money($semi_production->semi_product_items->pluck('semi_pro_qty')->sum())}}</b></div>
                                                </td>
                                                <td>
                                                    @foreach ($semi_production->semi_product_items->pluck('semi_pro_weight') as $semi_pro_weight)
                                                        <div>{{ $semi_pro_weight }}</div><br>
                                                    @endforeach
                                                    <div><b>{{money($semi_production->semi_product_items->pluck('semi_pro_weight')->sum())}}</b></div>
                                                </td>
                                                <td>{{ $semi_production->plant->plant_number }}</td>
                                                <td>{{ $semi_production->warehouse->warehouse_code }}</td>
                                                {{-- <td>{{ $semi_production->tot_raw_material_qty }}</td>
                                                <td>{{ $semi_production->tot_semi_product_qty }}</td> --}}
                                                <td>{{ date('Y-m-d', strtotime($semi_production->created_at)) }}</td>
                                                {{-- <td>
                                                    <a href="{{ route('semiproduction.edit', $semiproduction->id) }}">
                                                    <i class="mdi mdi-pencil text-dark"></i></a>

                                                    <a href="{{ route('semiproduction.delete', $semiproduction->id) }}">
                                                    <i class="mdi mdi-delete text-danger"></i></a>

                                                    <a href="{{ route('semiproduction.view', $semiproduction->id) }}">
                                                    <i class="mdi mdi-eye text-dark"></i></a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                {{ $semi_productions->links('pagination::bootstrap-5') }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     $('#tbl_semiproduction').DataTable();
        // });
    </script>
@endpush
