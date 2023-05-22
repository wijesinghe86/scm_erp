@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Miscellaneous Received Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('miscreceived.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Supplier Code</label>
                                    <input type="text" class="form-control" id="supplier_code" name="supplier_code"
                                        placeholder="Supplier Code" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Supplier Name</label>
                                    <select class="form-control item-select" name="supplier_id" id="supplier_id"
                                        onchange="getSupplier()">
                                        <option selected disabled>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
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
                                <div class="form-group col-md-2">
                                    <label>Doc Date</label>
                                    <input type="date" class="form-control" name="misc_date" placeholder="Date">
                                </div>
                            </div>
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
                                    <label>Revd Qty</label>
                                    <input type="number" class="form-control" name="rec_qty" id="rec_qty" min="0"
                                        step="0.01" placeholder="Revd Qty">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Revd Weight</label>
                                    <input type="number" class="form-control" name="rec_weight" id="rec_weight" min="0"
                                        step="0.01" placeholder="Revd Weight">
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
                                <button type="submit" class="btn btn-success me-2">Complete Miscellaneous Received</button>
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
        function getSupplier() {
            var supplier_id = $('#supplier_id').val();
            console.log(supplier_id);
            var data = {
                supplier_id: supplier_id
            };
            $.ajax({
                url: "{{ route('supplier.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#supplier_code').val(response.supplier_code);
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
        function addInvoiceItem(rec_no) {
            // console.log(invoice_no);

            //passing the value to Item table
            var item_id = $('#item_id').val();
            var rec_qty = $('#rec_qty').val();
            var rec_weight = $('#rec_weight').val();
            var location_id = $('#location_id').val();
            console.log(item_id);
            var data = {
                item_id: item_id,
                rec_qty: rec_qty,
                rec_weight:rec_weight,
                location_id: location_id,
                rec_no: rec_no,
            };
            $.ajax({
                url: "{{ route('miscreceived.item.store') }}",
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
            var rec_no = '{{ $misc_number }}';
            var data = {
                rec_no: rec_no
            };
            console.log(data);
            $.ajax({
                url: "{{ route('miscreceived.item.table') }}",
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
