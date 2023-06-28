@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Materials Request Form Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('raw_material_request.store') }}">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Request No</label>
                                    <input type="text" class="form-control" name="rmr_no" value="{{ $next_number }}"
                                        placeholder="Req No">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Request Date</label>
                                    <input type="date" class="form-control" name="req_date" value="{{ old('req_date') }}"
                                        placeholder="Req date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Requested By</label>
                                    <select class="form-control" name="requested_by" placeholder="Reqested By"
                                        value="{{ old('requested_by') }}">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"> {{ $employee->employee_fullname }} -
                                                {{ $employee->departmentData->department_name }}
                                                ({{ $employee->sectionData->section_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Required Date</label>
                                    <input type="date" class="form-control" name="required_date"
                                        value="{{ old('required_date') }}" id="required_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label>Justification</label>
                                    <input type="text" class="form-control" name="justification"
                                        value="{{ old('justification') }}" placeholder="Justification">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Job Order No</label>
                                    <select class="form-control" name="job_order_no" id="job_order_no">
                                        <option value="" selected disabled>Select job order</option>
                                        @foreach ($job_orders as $job_order)
                                            <option value="{{ $job_order->id }}">
                                                {{ $job_order->job_order_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Plant</label>
                                    <input readonly type="text" class="form-control" name="plant" id="plant"
                                        value="{{ old('plant') }}" placeholder="Plant">
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock No</label>
                                    <input readonly type="text" class="form-control" id="selected_stock_number"
                                        value="{{ old('plant') }}" placeholder="">
                                </div>
                                <input readonly type="hidden" id="selected_jo_item_id" value="">
                                <div class="form-group col-md-4">
                                    <label>Job Order Item</label>
                                    <select id="selected_job_order_items" class="form-control item-select"
                                        name="selected_job_order_item">
                                        <option selected disabled>Select Item</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Jo Qty</label>
                                    <input readonly type="text" class="form-control" id="selected_jo_qty"
                                        value="{{ old('plant') }}" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock Item</label>
                                    <select class="form-control item-select clear-qty" id="item_id">
                                        <option value="" selected>Select Item</option>
                                        @foreach ($stock_items as $stockItem)
                                            <option value="{{ $stockItem->id }}">
                                                {{ $stockItem->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Stock Item Qty</label>
                                    <input type="text" class="form-control" id="item_qty" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Stock Item Weight</label>
                                    <input type="text" class="form-control" id="item_weight" value=""
                                        placeholder="">
                                </div>
                            </div>
                            <button type="button" class="btn btn-success me-2" onclick="onAddItemClick()">Add</button>
                            <br>
                            <br>
                            <div id="item_cart"></div>
                            <button type="submit" class="btn btn-success me-2">
                                Complete Materials Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const jobOrders = <?php echo json_encode($job_orders); ?>;
            let selectedJobOrderItems = [];

            $(document).ready(function() {
                viewCartTable()
                $('.item-select').select2({
                    placeholder: "Select Item",
                });
            });

            $('#job_order_no').on('change', function() {
                let jobOrderId = $(this).val();
                const jobOrder = jobOrders.find(row => row?.id == jobOrderId)
                $('#plant').val(jobOrder?.plant?.plant_number);

                if (jobOrder?.items?.length > 0) {
                    selectedJobOrderItems = jobOrder?.items;
                    $('#selected_job_order_items').find('option').remove().end()
                    $('#selected_job_order_items').append(
                        '<option selected disabled>Select Item</option>');
                    jobOrder?.items.forEach(element => {
                        $('#selected_job_order_items').append('<option  value="' + element.id +
                            '">' + element?.stock_item?.description + '</option>');
                    })
                }
            })
            $('#selected_job_order_items').on('change', function() {
                let jobOrderItemId = $(this).val();
                const jobOrderItem = selectedJobOrderItems?.find(row => row?.id == jobOrderItemId)
                $('#selected_stock_number').val(jobOrderItem?.stock_item?.stock_number);
                $('#selected_jo_qty').val(jobOrderItem?.jo_qty);
                $('#selected_jo_item_id').val(jobOrderItem?.id);
            })


            function onAddItemClick() {
                let job_order_stock_id = $('#selected_job_order_items').val();
                let job_order_id = $('#selected_jo_item_id').val();
                let stock_item_id = $('#item_id').val();
                let item_qty = $('#item_qty').val();
                let item_weight = $('#item_weight').val();


                let data = {
                    job_order_stock_id,
                    job_order_id,
                    stock_item_id,
                    item_qty,
                    item_weight,
                }

                $.ajax({
                    url: "{{ route('raw_material_request.addItem') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data,
                    success: function(response) {
                        alertSuccess("Item added successfully")
                        viewCartTable();
                        $('#item_qty').val("");
                        $('#item_weight').val("");
                        $('#item_id').val("").trigger('change');
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
                    url: "{{ route('raw_material_request.deleteItem') }}",
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
                    url: "{{ route('raw_material_request.viewCartTable') }}",
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
