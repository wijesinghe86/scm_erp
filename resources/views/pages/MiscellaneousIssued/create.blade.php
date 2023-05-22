@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Miscellaneous Issued Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('miscissued.store') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" id="cus_code" name="cus_code"
                                        placeholder="Customer Code" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Name</label>
                                    <select class="form-control item-select" name="customer_id" id="customer_id"
                                        onchange="getCustomer()">
                                        <option selected disabled>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Ref No</label>
                                    <input type="text" class="form-control" name="ref_number"
                                        placeholder="Reference Number">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Doc No</label>
                                    <input type="text" class="form-control" name="misc_number" value="{{ $misc_number }}"
                                        placeholder="Document Number">
                                </div>
                                {{-- <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <select class="form-control item-select" name="location_id" id="location_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group col-md-2">
                                    <label>Doc Date</label>
                                    <input type="date" class="form-control" name="misc_date" placeholder="Date">
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Material Received Document Number</label>
                                    <input type="text" class="form-control" name="materialreceiveddocumentnumber"
                                    placeholder="Material Received Document Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Material Issued Document Number</label>
                                    <input type="text" class="form-control" name="materialissueddocumentnumber"
                                    placeholder="Material Issued Document Number">
                                </div>
                            </div> --}}

                            <hr>

                            {{-- Invoice Items Start here --}}
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                    <input type="text" class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Description</label>
                                    <select class="form-control item-select" name="item_id" id="item_id"
                                        onchange="getStockItem()">
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
                                    <input type="text" class="form-control" name="uom" id="uom"
                                        placeholder="U/M">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Iss Qty</label>
                                    <input type="number" class="form-control" name="iss_qty" id="iss_qty" min="0"
                                        step="0.01" placeholder="Iss Qty">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Iss Weight</label>
                                    <input type="number" class="form-control" name="iss_weight" id="iss_weight" min="0"
                                        step="0.01" placeholder="Iss Weight">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <select class="form-control item-select" name="location_id" id="location_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Invoice Items End here --}}

                            <button type="button" class="btn btn-success me-2" onclick="addInvoiceItem('{{ $misc_number }}')">Add
                            </button>
                            <br>
                            <br>
                            {{-- Invoice Items table Start here --}}
                            <div class="row">
                                <div class="col-md-12" id="items-table">
                                </div>
                            </div>
                            {{-- Invoice Items table End here --}}
                            <BR>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success me-2">Complete Miscellaneous Issued</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // get the Customer Details from Customer Table
        $(document).ready(function() {
            getItemsTable();
        });

        // get the Customer Details from Customer Table
        function getCustomer() {
            var customer_id = $('#customer_id').val();
            console.log(customer_id);
            var data = {
                customer_id: customer_id
            };
            $.ajax({
                url: "{{ route('customer.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#cus_code').val(response.customer_code);
                }
            });
        }
        // get the Stock Item Details from StockItem Table
        function getStockItem() {
            var item_id = $('#item_id').val();
            console.log(item_id);
            var data = {
                item_id: item_id
            };
            $.ajax({
                url: "{{ route('stockitem.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#stock_no').val(response.stock_number);
                    $('#uom').val(response.unit);
                }
            });
        }

        // get the Location Details from Warehouse Table
        function addInvoiceItem(issued_no) {
            // console.log(invoice_no);

            //passing the value to Item table
            var item_id = $('#item_id').val();
            var iss_qty = $('#iss_qty').val();
            var iss_weight = $('#iss_weight').val();
            var location_id = $('#location_id').val();
            console.log(item_id);
            var data = {
                item_id: item_id,
                iss_qty: iss_qty,
                iss_weight:iss_weight,
                location_id: location_id,
                issued_no: issued_no,
            };
            $.ajax({
                url: "{{ route('miscissued.item.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: data,
                success: function(response) {
                    getItemsTable();
                }
            });
        }

        function getItemsTable() {
            var issued_no = '{{ $misc_number }}';
            var data = {
                issued_no: issued_no
            };
            console.log(data);
            $.ajax({
                url: "{{ route('miscissued.item.table') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#items-table').html(response);
                }
            });
        }

        $(document).ready(function() {
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .select2-container .select-selection--single {
            height: 46px;
        }
    </style>
@endpush
