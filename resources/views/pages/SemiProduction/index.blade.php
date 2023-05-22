@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Semi Goods Report</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('semiproduction.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('semiproduction.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                        </div>
                        <table class="table table-bordered" id="tbl_semiproduction">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Semi Product Number</td>
                                    <td>Goods Receiving Number</td>
                                    <td>Stock Number</td>
                                    <td>Serial Number</td>
                                    <td>Semi Product Serial Number</td>
                                    {{-- <td>Plant Number</td>
                                    <td>Warehouse Code</td>
                                    <td>Semi Product Location Code</td>
                                    <td>Actual Raw Material Serial Weight</td>
                                    <td>Date</td>
                                    <td>Semi Product Quantity</td>
                                    <td>Semi Product Weight</td> --}}
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($semiproductions as $semiproduction)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $semiproduction->semi_product_number}}</td>
                                    <td>{{ $semiproduction->grn_number}}</td>
                                    <td>{{ $semiproduction->stock_number}}</td>
                                    <td>{{ $semiproduction->serial_number}}</td>
                                    <td>{{ $semiproduction->semi_product_serial_number}}</td>
                                    <td>{{ $semiproduction->plant_number}}</td>
                                    <td>{{ $semiproduction->warehouse_code}}</td>
                                    <td>{{ $semiproduction->semi_product_location_code}}</td>
                                    <td>{{ $semiproduction->actual_raw_material_serial_weight}}</td>
                                    <td>{{ $semiproduction->date}}</td>
                                    <td>{{ $semiproduction->semi_product_quantity}}</td>
                                    <td>{{ $semiproduction->semi_product_weight}}</td>


                                     <td>
                                        <a href="{{ route('semiproduction.edit', $semiproduction->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('semiproduction.delete', $semiproduction->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>

                                        <a href="{{ route('semiproduction.view', $semiproduction->id) }}">
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
            $('#tbl_semiproduction').DataTable();
        } );
    </script>
@endpush
