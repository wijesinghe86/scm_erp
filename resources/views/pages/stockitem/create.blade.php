@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Item Creation</h4>
                        <form class="forms-sample" method="POST" action="{{ route('stockitem.store') }}">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Stock Number *</label>
                                        <input type="text" class="form-control" name="stock_number"
                                            placeholder="Stock Number">
                                    </div>
                                </div>

                                <hr>
                                <b><p class="card-description"> Description Details </p><b>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Description *</label>
                                        <input type="text" class="form-control" name="description" placeholder="Description" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Unit of Measure *</label>
                                        <input type="text" class="form-control" name="unit" placeholder="Unit of Measure">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Cost Price</label>
                                        <input type="number" class="form-control" name="cost_price" placeholder="Cost Price">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Barcode</label>
                                        <input type="text" class="form-control" name="barcode" placeholder="Barcode">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Keyword *</label>
                                        <input type="text" class="form-control" name="keyword" placeholder="Keyword">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Group *</label>
                                        <input type="text" class="form-control" name="group" placeholder="Group">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Class *</label>
                                        <input type="text" class="form-control" name="class" placeholder="Class">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Serial Number</label>
                                        <input type="text" class="form-control" name="serial_number"
                                            placeholder="Serial Number">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Part Number</label>
                                        <input type="text" class="form-control" name="part_number" placeholder="Part Number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Model</label>
                                        <input type="text" class="form-control" name="model" placeholder="Model">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Make</label>
                                        <input type="text" class="form-control" name="make" placeholder="Make">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Substitute Item</label>
                                        <input type="text" class="form-control" name="substitute_stock_number"
                                            placeholder="Substitute Item">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>End User</label>
                                        <select class="form-control item-select" name="enduser">
                                            @foreach ($departments as $department )
                                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Stock Item Grade</label>
                                        <input type="text" class="form-control" name="stock_item_Grade"
                                            placeholder="Stock Item Grade">
                                    </div>
                                </div>
                                <hr>
                                <b><p class="card-description"> Chemical Properties </p><b>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Chemical C</label>
                                        <input type="text" class="form-control" name="stock_item_chem_c" placeholder="Chemical C">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Chemical Mn</label>
                                        <input type="text" class="form-control" name="stock_item_chem_mn" placeholder="Chemical Mn">
                                    </div>
                                </div>

                                <hr>
                                <b><p class="card-description"> Mechanical Properties </p><b>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Mechanical Ys</label>
                                        <input type="text" class="form-control" name="stock_item_mech_ys"
                                            placeholder="Mechanical Ys">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mechanical Ts</label>
                                        <input type="text" class="form-control" name="stock_item_mech_ts"
                                            placeholder="Mechanical Ts">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mechanical Ei</label>
                                        <input type="text" class="form-control" name="stock_item_mech_ei"
                                            placeholder="Mechanical Ei">
                                    </div>
                                </div>

                                <hr>
                                <b><p class="card-description"> Physical Properties </p><b>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Physical Weight</label>
                                        <input type="number" class="form-control" name="stock_item_physical_weight"
                                            placeholder="Physical Weight">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Physical Width</label>
                                        <input type="number" class="form-control" name="stock_item_physical_width"
                                            placeholder="Physical Width">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Physical Thickness</label>
                                        <input type="number" class="form-control" name="stock_item_physical_thickness"
                                            placeholder="Physical Thickness">
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Date of Manufactor</label>
                                        <input type="date" class="form-control" name="stock_item_date_of_mfr"
                                            placeholder="Date of Manufactor">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Date of Expiry</label>
                                        <input type="date" class="form-control" name="stock_item_date_of_expiry"
                                            placeholder="Date of Expiry">
                                    </div>
                                </div>

                                <b><p class="card-description"> Quantity Details </p><b>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Minimum Quantity</label>
                                        <input type="number" class="form-control" name="minimum_quantity" placeholder="Minimum Quantity">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Maximum Quantity</label>
                                        <input type="number" class="form-control" name=">maximum_quantity" placeholder="Maximum Quantity">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Re-Order Level</label>
                                        <input type="number" class="form-control" name="re_order_level" placeholder="Re-Order Level">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Special Instructions</label>
                                        <input type="text" class="form-control" name="stock_item_special_ins" placeholder="Special Instructions">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Storage Method</label>
                                        <input type="text" class="form-control" name="stock_item_storage_method" placeholder="Storage Method">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Handling Method</label>
                                        <input type="text" class="form-control" name="stock_item_handling_method" placeholder="Handling Method">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Inspection Required Status</label>
                                        <select class="form-control" name="stock_item_inspection_reuired">
                                            <option selected disabled>Select Status</option>
                                            <option value="1">Yes</option>
                                            <option value="1">No</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success me-2">Submit</button>
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
