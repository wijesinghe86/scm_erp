@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title">New {{ $setting->invoice_type_name }} Creation</h4>
                        <br>
                        <form action="{{ route('invoices.store') }}" method="POST">
                            @csrf
                            <div style="position: relative;">
                                <div style="display:none; position: absolute; bottom:0; right:0;" id="stockView">
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
                                {{-- Customer Selection Start here --}}
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
                                    <div class="form-group col-md-6">
                                        <label>Customer Address</label>
                                        <input type="text" class="form-control" id="cus_address" name="cus_address"
                                            placeholder="Customer Address" disabled>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Customer VAT Number</label>
                                        <input type="text" class="form-control" id="cus_vat_no" name="cus_vat_no"
                                            placeholder="Customer VAT Number" disabled>
                                    </div>
                                </div>
                                {{-- Customer Selection End here --}}

                                {{-- Invoice Section Start here --}}
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Invoice No</label>
                                        <input type="text" class="form-control" value="{{ $invoice_number }}"
                                            name="invoice_number", id="invoice_number" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Invoice Category</label>
                                        <input type="text" class="form-control" value="{{ $invoiceOption }}" readonly>
                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                    <label>Tax</label></label>
                                    <input type="text" class="form-control" value="{{ $tax }}" name="tax",
                                        id="invoice_number" readonly>
                                </div> --}}

                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                                            {{ now()->format('Y-m-d') }}>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>PO No</label>
                                        <input type="text" class="form-control" name="po_number", id="po_number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Reference No</label>
                                        <input type="text" class="form-control" name="ref_number", id="ref_number">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Term</label>
                                        <select name="payment_terms" class="form-control item-select" id="payment_terms">
                                            <option selected disabled>Select Terms</option>
                                            <option value="1">Cash</option>
                                            <option value="2">Credit</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Invoice Section End here --}}

                                {{-- Sales Staff Selection Start here --}}
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Sales Staff Code</label>
                                        <input type="text" class="form-control" id="employee_reg_no"
                                            name="employee_reg_no" placeholder="Customer Code" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Sales Staff Name</label>
                                        <select class="form-control item-select" name="employee_id" id="employee_id"
                                            onchange="getEmployee()">
                                            <option selected disabled>Select Sales Staff</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->employee_fullname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Sales Staff Selection Start here --}}
                            </div>
                            <hr>
                            <br>
                            {{-- Invoice Items Start here --}}
                            <div class="row">
                                {{-- <div class="form-group col-md-1">
                                    <label>I/No</label>
                                    <input type="text" class="form-control" id="item_no" placeholder="I/No"
                                        value="1">
                                </div> --}}
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                    <input type="text" class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Description</label>
                                    <select class="form-control item-select clear-qty" name="item_id" id="item_id"
                                        onchange="getStockItem()">
                                        <option value="" selected disabled>Select Item</option>
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
                                    <label>Order Qty</label>
                                    <input type="number" class="form-control" name="quantity"
                                        id="quantity"onkeypress="getTotal()" min="0" step="0.01"
                                        placeholder="Order Qty">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Unit Rate (Rs.)</label>
                                    <input type="number" class="form-control" name="unit_price" id="unit_price"
                                        onkeypress="getTotal()" min="0" step="0.01"
                                        placeholder="Unit Rate (Rs.)" onchange="calculateUnitPrice(this)">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Discount</label>
                                    <input type="number" class="form-control"
                                        name="item_discount_percentage"onkeyup="getTotal()" min="0"
                                        step="0.01" id="item_discount_percentage" placeholder="Discount">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Item Discount Amount</label>
                                    <input type="number" class="form-control" placeholder="Item Amount" disabled
                                        id="item_discount_amount">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <select class="form-control item-select clear-qty" name="location_id"
                                        id="location_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            {{-- Invoice Items End here --}}

                            <button type="button" class="btn btn-success me-2"
                                onclick="addInvoiceItem('{{ $invoice_number }}')">Add</button>
                            <br>
                            <br>
                            {{-- Invoice Items table Start here --}}
                            <div class="row">
                                <div class="col-md-12" id="items-table">
                                </div>
                            </div>
                            {{-- Invoice Items table End here --}}

                            <div class="row">
                                {{-- <div class="form-group col-md-2">
                                    <label>Total Line Items</label>
                                    <input type="text" class="form-control" value="{{ $item_count }}" readonly autocomplete="off">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Total Quantity</label>
                                    <input type="text" class="form-control" value="{{ $total_qty }}" readonly autocomplete="off">
                                </div> --}}
                                <div class="form-group col-md-2">
                                    <label>Sub Total(Rs.)</label>
                                    <input type="text" class="form-control js_subtotal" value="" readonly
                                        autocomplete="off" id="sub_total" name="sub_total">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Vat</label>
                                    <input type="text" class="form-control js_vatRate" value="" name="vat"
                                        readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Vat Amount</label>
                                    <input type="number" class="form-control js_vat" name="vat_amount" min="0"
                                        value="" step="0.01" id="vat_amount" placeholder="Discount">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Net Total</label>
                                    <input type="number" class="form-control js_netTotal" name="net_total"
                                        min="0" value="" step="0.01" id="net_total"
                                        placeholder="Discount">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Tot Discount %</label>
                                    {{-- <input type="number" class="form-control" autocomplete="off" name="Total_discount_percentage"
                                        id="Total_discount_percentage" id="Total_discount_percentage"> --}}

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control js_discount_amount"
                                            name="discount_amount" value="" placeholder="Discount"
                                            onchange="fetchInvoiceTotal()">
                                        <span class="input-group-text" id="basic-addon2" style="margin:0;padding:0;">
                                            <select name="discount_type"
                                                class="form-control form-control-lg js_discount_type" style="height:100%;"
                                                onchange="fetchInvoiceTotal()">
                                                <option value="fixed">RS</option>
                                                <option value="percentage">%</option>
                                            </select>
                                        </span>
                                    </div>

                                </div>
                                {{-- <div class="form-group col-md-2">
                                    <label>Tot Discount Amount</label>
                                    <input type="number" class="form-control" autocomplete="off" name="Total_discount_amount"
                                        id="Total_discount_amount">
                                </div> --}}
                                <div class="form-group col-md-2">
                                    <label>Grand Total (Rs.)</label>
                                    <input type="text" class="form-control js_grandTotal" readonly autocomplete="off"
                                        value="" name="grand_total" id="grand_total">
                                </div>
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">Create & View</button>
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
        let selectedItemData = {};
        // get the Customer Details from Customer Table
        $(document).ready(function() {
            getItemsTable();
            fetchInvoiceTotal();
        });

        $('.clear-qty').on('change', function() {
            $('#quantity').val("")
        })

        $('#quantity').on('change', function() {
            const warehouse = $('#location_id').val();
            let quantity = $(this).val();
            if (Object.keys(selectedItemData)?.length > 0) {
                const filterCurrentStockData = selectedItemData?.stocks?.find(row => row?.warehouse?.id ==
                    warehouse)
                if (parseFloat(quantity) > parseFloat(filterCurrentStockData?.qty)) {
                    $(this).val(filterCurrentStockData?.qty)
                }
            }

        })

        function fetchInvoiceTotal() {
            $.ajax({
                url: "{{ route('invoices.get.total') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    invoice_no: "{{ $invoice_number }}",
                    discount_type: $('.js_discount_type').val(),
                    discount_amount: $('.js_discount_amount').val(),
                    option: "{{ $invoiceOption }}"
                },
                success: function(response) {
                    $(".js_subtotal").val(response.subtotal);
                    $(".js_vatRate").val(response.vatRate)
                    $(".js_vat").val(response.vat)
                    $(".js_netTotal").val(response.netTotal)
                    $(".js_grandTotal").val(response.grandTotal)

                }
            });
        }

        function calculateUnitPrice(elem) {
            var category = "{{ $invoiceOption }}";
            if (category != "Option A") {
                return;
            }
            var unitPrice = parseFloat($(elem).val());
            var vatRate = 15;
            var newUnitPrice = unitPrice / ((100 + vatRate) / 100);
            $(elem).val(newUnitPrice.toFixed(2));
        }

        // get the Customer Details from Customer Table
        function getCustomer() {
            var customer_id = $('#customer_id').val();
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
                    $('#cus_code').val(response.customer_code);
                    $('#cus_address').val(response.customer_address_line1);
                    $('#cus_vat_no').val(response.customer_vat_number);
                }
            });
        }

        // get the Employee Details from Employee Table
        function getEmployee() {
            var employee_id = $('#employee_id').val();
            var data = {
                employee_id: employee_id
            };
            $.ajax({
                url: "{{ route('employee.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    $('#employee_reg_no').val(response.employee_reg_no);
                }
            });
        }

        // get the Stock Item Details from StockItem Table
        function getStockItem() {
            var item_id = $('#item_id').val();
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
                    $('#stock_no').val(response?.stock_number);
                    $('#uom').val(response?.unit);
                    $('#stockView').hide();

                    selectedItemData = response

                    if (response?.stocks?.length > 0) {
                        $('#stockViewItems').find('tr').remove().end()
                        response?.stocks.forEach(element => {
                            $('#stockViewItems').append(
                                `<tr><td>${element?.warehouse?.warehouse_name}</td><td align="right" >${element?.qty}</td></tr>`
                            )
                        })
                        $('#stockView').show();
                    }
                }
            });
        }

        // get the Location Details from Warehouse Table
        function addInvoiceItem(invoice_no) {

            //passing the value to Item table
            var item_id = $('#item_id').val();
            var quantity = $('#quantity').val();
            var unit_price = $('#unit_price').val();
            var item_discount_amount = $('#item_discount_amount').val();
            var item_discount_percentage = $('#item_discount_percentage').val();
            var location_id = $('#location_id').val();
            // var customer_id = $('#customer_id').val();
            var data = {
                item_id: item_id,
                quantity: quantity,
                unit_price: unit_price,
                item_discount_amount: item_discount_amount,
                item_discount_percentage: item_discount_percentage,
                location_id: location_id,
                invoice_no: invoice_no,
                // customer_id: customer_id,
            };
            $.ajax({
                url: "{{ route('invoices.item.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: data,
                success: function(response) {
                    console.log(response);
                    fetchInvoiceTotal();
                    if (response.status == 0) {
                        alertDanger(response.message);
                    } else {
                        $('#stock_no').val("");
                        $('#uom').val("");
                        $('#item_id').val("");
                        $('#quantity').val("");
                        $('#unit_price').val("");
                        $('#item_discount').val("");
                        $('#location_id').val("");
                    }
                    getItemsTable();
                },
                error: function(data) {
                    $.each(data.responseJSON?.errors, function(key, value) {
                        alertDanger(value);
                    });
                }
            });
        }

        function getItemsTable() {
            var invoice_no = '{{ $invoice_number }}';
            var data = {
                invoice_no: invoice_no
            };
            $.ajax({
                url: "{{ route('invoices.item.table') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    $('#items-table').html(response);
                }
            });
        }

        //get item discount amount
        function getTotal() {
            var unit_price = $("#unit_price").val();
            var quantity = $("#quantity").val();
            var item_discount_percentage = $("#item_discount_percentage").val();

            if (unit_price && quantity && item_discount_percentage) {
                let price = parseFloat(quantity * unit_price);
                console.log({price});
                console.log({item_discount_percentage});
                var item_discount_amount = parseFloat((price*item_discount_percentage)/ 100)?.toFixed(2);
                $("#item_discount_amount").val(item_discount_amount)
            }
        }

        function removeFromCart(item) {
            let data = {
                cartData: item
            }
            $.ajax({
                url: "{{ route('invoices.item.delete') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: data,
                success: function(response) {
                    getItemsTable()
                }
            });
        }

        $(document).ready(function() {
            $('.item-select').select2({
                placeholder: "Select Item",
                // theme: 'bootstrap4',
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* .select2-container .select-selection--single {
            height: 46px;
        } */
    </style>
@endpush
