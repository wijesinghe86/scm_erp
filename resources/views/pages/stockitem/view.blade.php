@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Item Details View</h4>
                        <form class="forms-sample">
                            <br>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Stock Number :  </label>
                                        <span>{{$stockitems->stock_number}}</span>
                                    </div>
                                </div>

                                <hr>
                                <b><p class="card-description"> Description Details :</p><b>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Description :</label>
                                        <span>{{$stockitems->description}}</span>
                                     </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Unit of Measure :</label>
                                        <span>{{$stockitems->unit}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cost Price :</label>
                                        <span>{{$stockitems->cost_price}}</span>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Barcode :</label>
                                        <span>{{$stockitems->barcode}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Keyword :</label>
                                        <span>{{$stockitems->keyword}}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Group :</label>
                                        <span>{{$stockitems->group}}</span>
                                     </div>
                                    <div class="form-group col-md-6">
                                        <label>Class :</label>
                                        <span>{{$stockitems->class}}</span>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Serial Number :</label>
                                        <span>{{$stockitems->serial_number}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Part Number :</label>
                                        <span>{{$stockitems->part_number}}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Model :</label>
                                        <span>{{$stockitems->model}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Make :</label>
                                        <span>{{$stockitems->make}}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Substitute Item :</label>
                                        <span>{{$stockitems->substitute_stock_number}}</span>
                                    </div>
                                    {{-- <div class="form-group col-md-4">
                                        <label>End User</label>
                                        <span>{{$stockitems->enduser}}</span>
                                        <select class="form-control item-select" name="enduser">
                                            @foreach ($departments as $department )
                                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group col-md-6">
                                        <label>stock item Grade :</label>
                                        <span>{{$stockitems->stock_item_Grade}}</span>
                                    </div>
                                </div>

                                <hr>

                                <b><p class="card-description"> Chemical Properties </p><b>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Chemical C :</label>
                                        <span>{{$stockitems->stock_item_chem_c}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Chemical Mn :</label>
                                        <span>{{$stockitems->stock_item_chem_mn}}</span>
                                    </div>
                                </div>

                                <hr>
                                <b><p class="card-description"> Mechanical Properties </p><b>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Mechanical Ys :</label>
                                        <span>{{$stockitems->stock_item_mech_ys}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Mechanical Ts :</label>
                                        <span>{{$stockitems->stock_item_mech_ts}}</span>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Mechanical Ei :</label>
                                        <span>{{$stockitems->stock_item_mech_ei}}</span>
                                    </div>
                                </div>

                                <hr>
                                <b><p class="card-description"> Physical Properties </p><b>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Physical Weight :</label>
                                        <span>{{$stockitems->stock_item_physical_weight}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Physical Width :</label>
                                        <span>{{$stockitems->stock_item_physical_width}}</span>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Physical Thickness :</label>
                                        <span>{{$stockitems->stock_item_physical_thickness}}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Date of Manufactor :</label>
                                        <span>{{$stockitems->stock_item_date_of_mfr}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Date of Expiry :</label>
                                        <span>{{$stockitems->stock_item_date_of_expiry}}</span>
                                    </div>
                                </div>

                                <b><p class="card-description"> Quantity Details </p><b>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Minimum Quantity :</label>
                                        <span>{{$stockitems->minimum_quantity}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Maximum Quantity :</label>
                                        <span>{{$stockitems->maximum_quantity}}</span>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Re-Order Level :</label>
                                        <span>{{$stockitems->re_order_level}}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Special Instructions :</label>
                                        <span>{{$stockitems->stock_item_special_ins}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Storage Method</label>
                                        <span>{{$stockitems->stock_item_storage_method}}</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Handling Method</label>
                                        <span>{{$stockitems->stock_item_handling_method}}</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Inspection Required Status</label>
                                        <span>{{$stockitems->stock_item_inspection_reuired}}</span>
                                    </div>
                                </div>

                                <a href="{{ route('stockitem.all') }}" class="btn btn-primary float-end mb-2"> Previous </a>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
<script>
    $(document).ready(function(){
        $('.item-select').select2(
            {
                placeholder: "Select Item",
            });
    });

</script>
@endpush

@push('styles')
<style>
    .select2-container .select-selection--single{
        height: 46px;
    }
    </style>

@endpush
