@extends('layouts.app')
@section('content')
    {{-- <div class="content-wrapper"> --}}
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Semi Production Process</h4>
                    <h4 class="card-title"> Raw Material Details</h4>
                    <form class="forms-sample" method="POST" action="{{ route('semiproduction.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Semi_Pro No</label>
                                <input type="text" class="form-control" name="semi_product_no"
                                    value="{{ $next_number }}" placeholder="Semi Product No" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Date</label>
                                <input type="date" value="{{date('Y-m-d')}}" class="form-control"
                                    name="product_date"value="{{ old('product_date') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Plant</label>
                                <select class="form-control item-select" name="plant">
                                    <option selected disabled>Select Plant</option>
                                    @foreach ($plants as $plant)
                                        <option value="{{ $plant->id }}"
                                            @if (old('plant') == $plant->id) selected @endif>{{ $plant->plant_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Warehouse</label>
                                <select class="form-control item-select" name="warehouse">
                                    <option selected disabled>Select</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            @if (old('warehouse') == $warehouse->id) selected @endif>
                                            {{ $warehouse->warehouse_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Raw Material</label>
                                <select name="stock_item_id" id="stock_item_id" class="form-control item-select">
                                    <option selected disabled>Select Item</option>
                                    @foreach ($grnItems as $grnItem)
                                        <option value="{{ $grnItem->id }}"
                                            @if (old('grnItem') == $grnItem->id) selected @endif>{{ $grnItem->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Stock No</label>
                                <input type="text" readonly class="form-control" name="stock_no" id="stock_no"
                                    placeholder="Stock No">
                            </div>
                            <div class="form-group col-md-3">
                                <label>U/M</label>
                                <input type="text" readonly class="form-control" name="uom" id="uom"
                                    placeholder="U/M">
                            </div>
                        </div>
                        <hr>
                        <h4 class="card-title"> Semi Production</h4>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Raw_Mat Serial No</label>
                                <select id="serial_number_picker" class="form-control" name="serial">
                                    <option selected disabled>Select Serial No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Qty</label>
                                <input type="text" class="form-control" name="qty" placeholder="Qty" id="qty">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Actual Weight</label>
                                <input type="text" class="form-control" name="actual_weight" id="actual_weight"
                                    placeholder="actual_weight">
                            </div>
                            <div class="form-group col-md-2">
                                <label>GRN No</label>
                                <input type="text" class="form-control" name="grn_no" id="grn_no"
                                    placeholder="GRN No">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Description</label>
                                <select name="semi_stock_item_id" class="form-control item-select" id="semi_stock_item_id">
                                    <option selected disabled>Select Item</option>
                                    @foreach ($stockItems as $item)
                                        <option value="{{ $item->id }}"> {{ $item->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Stock No</label>
                                <input type="text" readonly class="form-control" name="stockNo" id="stockNo"
                                    placeholder="Stock No">
                            </div>
                            <div class="form-group col-md-2">
                                <label>U/M</label>
                                <input type="text" readonly class="form-control" name="uom" id="unit"
                                    placeholder="U/M">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Semi Product Qty</label>
                                <input type="text" class="form-control" name="semi_qty" id="semi_qty"
                                    placeholder="Semi Qty">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Semi Product Weight</label>
                                <input type="text" class="form-control" name="semi_weight" id="semi_weight"
                                    placeholder="Semi Product Weight">
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label>Semi Product Serial No</label>
                                <input type="text" class="form-control" name="semi_serial_no" id="semi_serial_no"
                                    placeholder="Semi Serial No">
                            </div>
                        </div>
                        <button type="button" onclick="onAddItemClick()" class="btn btn-success me-2" name="button"
                            value="add">Add</button>
                        <div style="margin: 2rem 0;" id="item_cart"></div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Total Semi Product Qty</label>
                                <input type="text" class="form-control" name="tot_semi_product" id="tot_semi_product"
                                    readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Raw Material Qty</label>
                                <input type="text" class="form-control" name="tot_raw_material" id="tot_raw_material"
                                    readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Remaining Qty</label>
                                <input type="text" class="form-control" name="remaining_qty" id="remaining_qty"
                                    readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success me-2">Complete Semi Production</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection

@push('scripts')
    <script>
        let stockItems = <?php echo json_encode($stockItems); ?>;
        let rawMaterialCodes = <?php echo json_encode($rawMaterialCodes); ?>;
        // asd

        $(document).ready(function() {
            viewCartTable();
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });

        $('#stock_item_id').on('change', function() {
            let stock_id = $(this).val();
            const filterItem = stockItems.find(row => row?.id == stock_id);
            $('#stock_no').val(filterItem?.stock_number)
            $('#uom').val(filterItem?.unit)
            $.ajax({
                url: "{{ route('semiproduction.loadserial') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    item_id: stock_id
                },
                success: function(response) {
                    $('#serial_number_picker').find('option').remove().end()
                    $('#serial_number_picker').append(
                        '<option selected disabled>Select Serial No</option>');
                    response.forEach(element => {
                        $('#serial_number_picker').append('<option  value="' + element.id +
                            '">' + element.serial_no + '</option>');
                    })
                }
            });
        })

        $('#serial_number_picker').on('change', function() {
            let serial_number_id = $(this).val();
            const filterItem = rawMaterialCodes.find(row => row?.id == serial_number_id);
            $('#grn_no').val(filterItem?.grn.grn_no)
            $('#qty').val(filterItem?.qty)
            $('#actual_weight').val("")
            getNextSerialNumber(filterItem?.serial_no)
        })

        function getNextSerialNumber(serial_no) {
            $.ajax({
                url: "{{ route('semiproduction.getNextSemiProductSerialNumber') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    serial_no
                },
                success: function(response) {
                    $('#semi_serial_no').val(response)
                }
            });
        }

        $('#semi_stock_item_id').on('change', function() {
            let stock_id = $(this).val();
            const filterItem = stockItems.find(row => row?.id == stock_id);
            $('#stockNo').val(filterItem?.stock_number)
            $('#unit').val(filterItem?.unit)
        })


        function onAddItemClick() {
            let serial_number_picker = $('#serial_number_picker').val();
            const filterItem = rawMaterialCodes.find(row => row?.id == serial_number_picker);
            let actual_weight = $('#actual_weight').val();

            
            let stock_no = $('#stock_no').val();
            let stock_item_id = $('#stock_item_id').val();
            let serial = $('#serial_number_picker').val();
            let stockNo = $('#stockNo').val();
            let semi_stock_item_id = $('#semi_stock_item_id').val();
            let semi_qty = $('#semi_qty').val();
            let semi_weight = $('#semi_weight').val();
            let semi_serial_no = $('#semi_serial_no').val();

            let data = {
                serial_number_picker:filterItem?.serial_no ,
                actual_weight,
                stock_no,
                stock_item_id,
                serial,
                stockNo,
                semi_stock_item_id,
                semi_qty,
                semi_weight,
                semi_serial_no,
            }

            $.ajax({
                url: "{{ route('semiproduction.addSemiProducts') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data,
                success: function(response) {
                    $('#tot_semi_product').val(response?.semi_product_total_qty);
                    $('#tot_raw_material').val(response?.raw_material_total_qty);
                    $('#remaining_qty').val(response?.raw_material_total_qty - response
                    ?.semi_product_total_qty);

                    const filterItem = rawMaterialCodes.find(row => row?.id == serial);
                    getNextSerialNumber(filterItem?.serial_no)

                    $('#stockNo').val("");
                    $('#semi_stock_item_id').val("");
                    $('#semi_qty').val("");
                    $('#semi_weight').val("");
                    $('#semi_serial_no').val("");
                    $('#uom').val("");
                    $('#semi_stock_item_id').val("").trigger('change');
                    alertSuccess("Item added successfully")
                    viewCartTable();
                },
                error: function(data) {
                    $.each(data.responseJSON?.errors, function(key, value) {
                        alertDanger(value);
                    });
                }
            });
        }


        function onRemoveItemClick(e, index) {
            $.ajax({
                url: "{{ route('semiproduction.delete_item') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    index
                },
                success: function(response) {
                    let serial_number_picker = $('#serial_number_picker').val();
                    const filterItem = rawMaterialCodes.find(row => row?.id == serial_number_picker);
                    getNextSerialNumber(filterItem?.serial_no)
                    alertSuccess("Item removed successfully")
                    viewCartTable();
                }
            });
        }

        function viewCartTable() {
            $.ajax({
                url: "{{ route('semiproduction.viewCartTable') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {},
                success: function(response) {
                    $('#item_cart').html(response)
                }
            });
        }
    </script>
@endpush
