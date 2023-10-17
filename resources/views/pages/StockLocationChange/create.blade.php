@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Location Change Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('stocklocationchange.store') }}">
                            @csrf
                            <div class="row">
                                {{-- <div class="col-md-6"> --}}
                                <div class="form-group col-md-3">
                                    <label>SLC Number</label>
                                    <input type="text" value="{{ $next_number }}" class="form-control"
                                        name="slc_number" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SLC Date</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="slc_date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Issued Date</label>
                                    <input type="date" class="form-control" name="issued_date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Issued by</label>
                                    <select class="form-control item-select" name="issued_by">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>From Location</label>
                                    <select class="form-control" name="from_location">
                                        <option value="">Select Location</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>To Location</label>
                                    <select class="form-control" name="to_location">
                                        <option value="">Select Location</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="remarks">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Fleet</label>
                                    <select class="form-control" name="fleet_id">
                                        <option value="">Select Fleet</option>
                                        @foreach ($fleets as $fleet)
                                            <option value="{{ $fleet->id }}">
                                                {{ $fleet->fleet_registration_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Driver Name</label>
                                    <input type="text" class="form-control" name="delivered_by">
                                </div>
                            </div>
                            {{-- </div> --}}
                            <hr>
                            {{-- Invoice Items Start here --}}
                            <div style="position: relative;" class="row">
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                    <input type="text" readonly class="form-control" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Description</label>
                                    <select class="form-control item-select" id="stock_item_id">
                                        <option selected disabled>Select Item</option>
                                        @foreach ($stockItems as $stockItem)
                                            <option value="{{ $stockItem->id }}">
                                                {{ $stockItem->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>U/M</label>
                                    <input type="text" readonly class="form-control" id="uom" placeholder="U/M">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Issue Qty</label>
                                    <input type="number" class="form-control" id="issue_qty" min="0" step="0.01"
                                        placeholder="Issued Qty">
                                </div>
                                {{-- <div class="form-group col-md-3">
                                    <label>Revd Qty</label>
                                    <input type="number" class="form-control" id="revd_qty" min="0" step="0.01"
                                        placeholder="Revd Qty">
                                </div> --}}

                                <div style="display:none; position: absolute; bottom:-20px; right:0; width: 400px;"
                                    id="stockView">
                                    <table class="table table-striped">
                                        <thead style="background-color: lightgray">
                                            <tr>
                                                <th>Warehouse</th>
                                                <th align="right">Avilable Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stockViewItems">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- Invoice Items End here --}}
                            <button type="button" onclick="onAddClick()" class="btn btn-success me-2">Add</button>
                            <br>
                            <hr>
                            <br>
                            <div id="item_list"></div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success me-2">Complete Stock Location
                                    Change</button>                                  
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            let stockItems = <?php echo json_encode($stockItems); ?>;

            $(document).ready(function() {
                viewItemTable()
                $('.item-select').select2({
                    placeholder: "Select",
                });
            });


            $('#stock_item_id').on('change', function() {
                let stockItemId = $(this).val();
                let stockItem = stockItems?.find(row => row?.id == stockItemId);
                $('#stock_no').val(stockItem?.stock_number)
                $('#uom').val(stockItem?.unit)

                $('#stockView').hide();

                if (stockItem?.stocks?.length > 0) {
                    $('#stockViewItems').find('tr').remove().end()
                    stockItem?.stocks.forEach(element => {
                        $('#stockViewItems').append(
                            `<tr><td>${element?.warehouse?.warehouse_name}</td><td align="right" >${element?.qty}</td></tr>`
                        )
                    })
                    $('#stockView').show();
                }
            })

            function onAddClick() {
                let stock_item_id = $('#stock_item_id').val();
                let issue_qty = $('#issue_qty').val();
                let revd_qty = $('#revd_qty').val();

                $.ajax({
                    url: "{{ route('stocklocationchange.addItemToTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        stock_item_id,
                        issue_qty,
                        revd_qty,
                    },
                    success: function(response) {
                        $('#stock_no').val("")
                        $('#uom').val("")
                        $('#stock_item_id').val("").trigger('change');
                        $('#issue_qty').val("");
                        $('#revd_qty').val("");
                        viewItemTable();
                        $('#stockView').hide();
                    },
                    error: function(data) {
                        $.each(data.responseJSON?.errors, function(key, value) {
                            alertDanger(value);
                        });
                    }
                });
            }


            function onRemoveclick(e, index) {
                $.ajax({
                    url: "{{ route('stocklocationchange.removeItemFromTable') }}",
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
                    url: "{{ route('stocklocationchange.getItemTable') }}",
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
