@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Adjustment Creation</h4>
                        <form class="forms-sample" method="POST" action="{{ route('stockadjustment.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock Adjustment Number</label>
                                    <input type="text" value="{{ $next_number }}" class="form-control"
                                        name="stock_adjustment_number" placeholder="Stock Adjustment Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Stock Adjustment Date</label>
                                    <input value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                        name="stock_adjustment_date " placeholder="Stock Adjustment Date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Type</label>
                                    <select class="form-control " name="type" id="type">
                                        <option value="">Select Type</option>
                                        <option value="short">Short</option>
                                        <option value="excess">Excess</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Created By</label>
                                    <select class="form-control " name="created_by">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Created Date</label>
                                    <input type="date" class="form-control" name="created_date"
                                        placeholder="Created Date">
                                </div>
                            </div>
                            <hr>
                            <div style="display: none;" class="main-container row">
                                <div class="form-group col-md-4">
                                    <label>From Warehouse</label>
                                    <select class="form-control " id="from_warehouse">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="display: none;" class="transfer-show  form-group col-md-4">
                                    <label>To Warehouse</label>
                                    <select class="form-control " id="to_warehouse">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Justification</label>
                                    <input type="text" class="form-control" id="justification"
                                        placeholder="Justification">
                                </div>
                            </div>

                            <div style="display: none;" class="main-container row">
                                <div class="form-group col-md-3">
                                    <label>From Stock Number</label>
                                    <input readonly type="text" class="form-control" id="from_stock_number">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>From Stock Description</label>
                                    <select style="width: 100%;" class="form-control item-select" id="from_stock_id">
                                        <option value="">Select Item</option>
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>From Unit</label>
                                    <input readonly type="text" class="form-control" id="from_stock_unit">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>From Stock in hand</label>
                                    <input readonly type="text" class="form-control" id="from_stock_stock_qty">
                                </div>
                            </div>

                            <div style="display: none;" class="main-container row">
                                <div class="form-group col-md-3 transfer-show">
                                    <label>To Stock Description</label>
                                    <input readonly type="text" class="form-control" id="to_stock_number">
                                </div>
                                <div style="display: none;" class="transfer-show form-group col-md-3">
                                    <label>Transfer To Stock Number</label>
                                    <select style="width: 100%;" class="form-control item-select" id="to_stock_id">
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 transfer-show">
                                    <label>To Unit</label>
                                    <input readonly type="text" class="form-control" id="to_stock_unit">
                                </div>
                                <div class="form-group col-md-3 transfer-show">
                                    <label>To Stock in hand</label>
                                    <input readonly type="text" class="form-control" id="to_stock_stock_qty">
                                </div>
                            </div>
                            <div style="display: none;" class="main-container row">

                                <div class="form-group col-md-3">
                                    <label>Quantity</label>
                                    <input type="number" onkeyup="onQtykeyUp(this)" class="form-control" id="qty"
                                        placeholder="Quantity">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Weight</label>
                                    <input type="number" class="form-control" id="weight" placeholder="Weight">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>From After</label>
                                    <input type="text" class="form-control" readonly id="from_after">
                                </div>
                                <div class="form-group col-md-3 transfer-show">
                                    <label>To After</label>
                                    <input type="text" class="form-control" readonly id="to_after">
                                </div>
                            </div>
                            <button type="button" onclick="addToTable()" style="display: none;margin:10px 0;"
                                class="main-container btn btn-success me-2">ADD</button>
                            <br>
                            <div id="item_list"></div>
                            <button type="submit" class="btn btn-success me-2">Complete Stock Adjustment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const stockItems = <?php echo json_encode($stock_items); ?>;

        $(document).ready(function() {
            // viewItemTable()
            $('.main-container').hide();
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });

        $('#type').on('change', function() {
            let type = $(this).val();
            // document.cookie = "san.items=[]";
            if (type != "") {
                $('.main-container').show();
                $('#to_stock_id').val("").trigger('change')
                $('#to_warehouse').val('')
                if (type != "transfer") {
                    $('.transfer-show').hide();
                }

                if (type == "transfer") {
                    $('.transfer-show').show();
                }
                return
            }
            if (type == "") {
                return $('.main-container').hide();
            }
        })

        function addToTable() {
            let from_warehouse = $('#from_warehouse').val();
            let to_warehouse = $('#to_warehouse').val();
            let justification = $('#justification').val();
            let from_stock_id = $('#from_stock_id').val();
            let to_stock_id = $('#to_stock_id').val();
            let qty = $('#qty').val();
            let weight = $('#weight').val();
            let type = $('#type').val();

            $.ajax({
                url: "{{ route('stockadjustment.addToTable') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    from_warehouse,
                    to_warehouse,
                    justification,
                    from_stock_id,
                    to_stock_id,
                    qty,
                    weight,
                    type
                },
                success: function(response) {
                    $('#from_warehouse').val("").trigger('change');
                    $('#to_warehouse').val("").trigger('change');
                    $('#justification').val("")
                    $('#from_stock_id').val("").trigger('change');
                    $('#to_stock_id').val("").trigger('change');
                    $('#qty').val("");
                    $('#weight').val("");
                    viewItemTable();
                },
                error: function(data) {
                    $.each(data.responseJSON?.errors, function(key, value) {
                        alertDanger(value);
                    });
                }
            });

        }

        function removeFromTable(e, index) {
            $.ajax({
                url: "{{ route('stockadjustment.removeFromTable') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    index
                },
                success: function(response) {
                    viewItemTable();
                }
            });
        }


        function viewItemTable() {
            $.ajax({
                url: "{{ route('stockadjustment.viewTable') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {},
                success: function(response) {
                    $('#item_list').html(response)
                }
            });
        }

        $('#from_stock_id').on('change', function() {
            let stockItemId = $(this).val();
            let warehouseId = $('#from_warehouse').val();

            const stockItem = stockItems.find(row => row?.id == stockItemId)
            const stock = stockItem?.stocks?.find(row => row?.stock_item_id == stockItemId && row?.warehouse_id ==
                warehouseId)
            $('#from_stock_number').val(stockItem?.stock_number)
            $('#from_stock_unit').val(stockItem?.unit)
            $('#from_stock_stock_qty').val(stock?.qty)
        });

        $('#to_stock_id').on('change', function() {
            let stockItemId = $(this).val();
            let warehouseId = $('#to_warehouse').val();

            const stockItem = stockItems.find(row => row?.id == stockItemId)
            const stock = stockItem?.stocks?.find(row => row?.stock_item_id == stockItemId && row?.warehouse_id ==
                warehouseId)
            $('#to_stock_number').val(stockItem?.stock_number)
            $('#to_stock_unit').val(stockItem?.unit)
            $('#to_stock_stock_qty').val(stock?.qty)
        });

        function onQtykeyUp(e) {
            let qty = e.value;
            if (qty == "") {
                qty = 0;
            }
            let type = $('#type').val();
            let from_stock_stock_qty = $('#from_stock_stock_qty').val();
            let to_stock_stock_qty = $('#to_stock_stock_qty').val();
            let from_after = $('#from_after').val();
            let to_after = $('#to_after').val();


            if (type == "short") {
                if (from_stock_stock_qty == "") return
                $('#from_after').val(parseFloat(from_stock_stock_qty) - parseFloat(qty));
                return
            }

            if (type == "excess") {
                if (from_stock_stock_qty == "") return
                $('#from_after').val(parseFloat(from_stock_stock_qty) + parseFloat(qty));
                return
            }

            if (type == "transfer") {
                if (from_stock_stock_qty) {
                    $('#from_after').val(parseFloat(from_stock_stock_qty) - parseFloat(qty));
                }
                if (to_stock_stock_qty) {
                    $('#to_after').val(parseFloat(to_stock_stock_qty) + parseFloat(qty));
                }
            }
        }
    </script>
@endpush
