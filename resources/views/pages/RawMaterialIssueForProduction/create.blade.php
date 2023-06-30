@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Material Issue For Production</h4>
                        <form class="forms-sample" method="POST" action="{{ route('rawmaterialissueforproduction.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Date</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="date"
                                        placeholder="Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>RMI No</label>
                                    <input type="text" class="form-control" value="{{ $next_number }}" name="rmi_no"
                                        placeholder="RMI No">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Warehouse</label>
                                    <select class="form-control item-select" name="warehouse_code">
                                      {{-- <option value="" selected>Select Warehouse</option> --}}
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>JOB No</label>
                                    <input type="text" class="form-control" readonly name="job_no" id="job_no"
                                        placeholder="job No">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Plant</label>
                                    <input type="text" class="form-control" readonly name="plant_no" id="plant_no"
                                        placeholder="Plant">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>RMR No</label>
                                    <select class="form-control" name="rmr_no" id="rmr_no">
                                        <option value="" selected>Select RMR</option>
                                        @foreach ($rmr_list as $rmr_item)
                                            <option value="{{ $rmr_item->id }}">
                                                {{ $rmr_item->rmr_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-10">
                                    <label>Requested by</label>
                                    <input type="text" class="form-control" readonly name="req_by" id="req_by"
                                        placeholder="Requested by">
                                </div>
                            </div>

                            <hr>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Request Item Stock No</label>
                                    <input readonly type="text" class="form-control" id="req_item_stock_number"
                                        value="{{ old('plant') }}" placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Request Item</label>
                                    <select id="req_item_id" class="form-control item-select">
                                        <option selected disabled>Select Request Item</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Request Qty</label>
                                    <input readonly type="text" class="form-control" id="req_item_qty" placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Request Weight</label>
                                    <input readonly type="text" class="form-control" id="req_item_weight" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Semi Product Serial Number</label>
                                    <select id="semi_product_item_id" class="form-control item-select">
                                        <option selected disabled>Select Request Item</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Semi Product Qty</label>
                                    <input type="text" readonly class="form-control" id="semi_product_item_qty"
                                        placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Semi Product Weight</label>
                                    <input type="text" readonly class="form-control" id="semi_product_item_weight"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" id="issue_qty" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Weight</label>
                                    <input type="number" class="form-control" id="issue_weight" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remark</label>
                                    <input type="text" class="form-control" id="issue_remark" placeholder="">
                                </div>
                            </div>


                            <button type="button" class="btn btn-success me-2" onclick="onAddItemClick()">Add</button>
                            <br>
                            <br>
                            <div id="item_cart"></div>
                            <br>
                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const rawMaterialRequests = <?php echo json_encode($rmr_list); ?>;
            let selectedRawMaterialRequestItems = [];
            let selectedSemiProductItems = [];
            $(document).ready(function() {
                viewCartTable()
                $('.item-select').select2({
                    placeholder: "Select Item",
                });
            });

            $('#rmr_no').on('change', function() {
                let rmrId = $(this).val();
                const rawMaterialRequest = rawMaterialRequests.find(row => row?.id == rmrId)
                $('#job_no').val(rawMaterialRequest?.job_order?.job_order_no);
                $('#plant_no').val(rawMaterialRequest?.plant_id);
                $('#req_by').val(rawMaterialRequest?.requested_by.employee_fullname);

                if (rawMaterialRequest?.items?.length > 0) {
                    selectedRawMaterialRequestItems = rawMaterialRequest?.items;
                    $('#req_item_id').find('option').remove().end()
                    $('#req_item_id').append(
                        '<option selected disabled>Select Item</option>');
                    rawMaterialRequest?.items.forEach(element => {
                        $('#req_item_id').append('<option  value="' + element.id +
                            '">' + element?.stock_item?.description + '</option>');
                    })
                }
            })

            $('#req_item_id').on('change', function() {
                let requestItemId = $(this).val();
                const requestItem = selectedRawMaterialRequestItems?.find(row => row?.id == requestItemId)

                $('#req_item_stock_number').val(requestItem?.stock_item.stock_number);
                $('#req_item_qty').val(requestItem?.req_qty);
                $('#req_item_weight').val(requestItem?.req_weight);
                $.ajax({
                    url: "{{ route('rawmaterialissueforproduction.getSemiProductSerials') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        raw_material_stock_no: requestItem?.raw_material_stock_no
                    },
                    success: function(response) {
                        if (response?.length > 0) {
                            selectedSemiProductItems = response;
                            $('#semi_product_item_id').find('option').remove().end()
                            $('#semi_product_item_id').append(
                                '<option selected disabled>Select Item</option>');
                            response.forEach(element => {
                                $('#semi_product_item_id').append('<option  value="' + element.id +
                                    '">' + element?.semi_pro_serial_no + '</option>');
                            })
                        }
                    }
                });
            })

            $('#semi_product_item_id').on('change', function() {
                let semiProductItemId = $(this).val();

                const semiProductItem = selectedSemiProductItems.find(row => row?.id == semiProductItemId)
                $('#semi_product_item_qty').val(semiProductItem?.semi_pro_qty);
                $('#semi_product_item_weight').val(semiProductItem?.semi_pro_weight);
            })

            function onAddItemClick() {
                let req_item_stock_number = $('#req_item_stock_number').val();
                let req_item_id = $('#req_item_id').val();
                let req_item_qty = $('#req_item_qty').val();
                let req_item_weight = $('#req_item_weight').val();
                let semi_product_item_id = $('#semi_product_item_id').val();
                let semi_product_item_qty = $('#semi_product_item_qty').val();
                let semi_product_item_weight = $('#semi_product_item_weight').val();
                let issue_qty = $('#issue_qty').val();
                let issue_weight = $('#issue_weight').val();
                let issue_remark = $('#issue_remark').val();

                let data = {
                    req_item_stock_number,
                    req_item_id,
                    req_item_qty,
                    req_item_weight,
                    semi_product_item_id,
                    semi_product_item_qty,
                    semi_product_item_weight,
                    issue_qty,
                    issue_weight,
                    issue_remark
                }

                $.ajax({
                    url: "{{ route('rawmaterialissueforproduction.addItem') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data,
                    success: function(response) {
                        alertSuccess("Item added successfully")
                        viewCartTable();
                        $('#semi_product_item_id').val("").trigger('change');
                        $('#semi_product_item_qty').val("");
                        $('#semi_product_item_weight').val("");
                        $('#issue_qty').val("");
                        $('#issue_weight').val("");
                        $('#issue_remark').val("");
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
                    url: "{{ route('rawmaterialissueforproduction.deleteItem') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        index
                    },
                    success: function(response) {
                        alertSuccess("Item removed successfully")
                        viewCartTable();
                    }
                });
            }


            function viewCartTable() {
                $.ajax({
                    url: "{{ route('rawmaterialissueforproduction.viewCartTable') }}",
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
@endsection
