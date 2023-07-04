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
                                <div class="form-group col-md-4">
                                    <label>From Stock Number</label>
                                    <select style="width: 100%;" class="form-control item-select" id="from_stock_id">
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->stock_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div style="display: none;" class="transfer-show form-group col-md-4">
                                    <label>Transfer To Stock Number</label>
                                    <select style="width: 100%;" class="form-control item-select" id="to_stock_id">
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->stock_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" id="qty" placeholder="Quantity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Weight</label>
                                    <input type="number" class="form-control" id="weight" placeholder="Weight">
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
    </script>
@endpush
