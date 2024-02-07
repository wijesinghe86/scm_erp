@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
{{--                        <h4 class="title">New {{ $setting->invoice_type_name }} Creation</h4>--}}
                        <br>
                        <form id="invoiceCreateForm" action="{{ route('invoices.store') }}" method="POST">
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
                                    <div id="customer_credit_limit_wrapper" style="display:none;"
                                        class="form-group col-md-3">
                                        <label>Customer Credit Limit</label>
                                        <input type="text" class="form-control" id="customer_credit_limit"
                                            placeholder="Customer Credit Limit" disabled>
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
{{--                                        <label>Invoice Category</label>--}}
{{--                                        <input type="text" class="form-control" value="{{ $invoiceOption }}" readonly>--}}

                                       <label>Invoice Setting</label>
                                        <select class="form-control item-select" name="" id="setting_id" onchange="getInvoiceSettings()">
                                            <option selected disabled> Invoice Setting</option>
                                            @foreach ($settings as $setting)
                                                <option value="{{ $setting->id }}">
                                                    {{ $setting->invoice_category }} - {{$setting->option->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="form-group col-md-2">
                                            <label>Invoice Type</label>
                                            <input type="text" class="form-control" name="invoice_type", id="invoice_type" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Option</label>
                                            <input type="text" class="form-control" name="invoice_option", id="invoice_option" readonly>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Invoice Category</label>
                                            <input type="text" class="form-control" name="invoice_category", id="invoice_category" readonly>
                                        </div>

                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                    <label>Tax</label></label>
                                    <input type="text" class="form-control" value="{{ $tax }}" name="tax",
                                        id="invoice_number" readonly>
                                </div> --}}
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                                            value="{{ now()->format('Y-m-d') }}">
                                    </div>
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
                                        <select name="payment_terms" class="form-control" id="payment_terms">
                                            <option selected value="" disabled>Select Terms</option>
                                            @foreach ($customer::$PAYMENT_TERMS as $item)
                                                <option value="{{ $item['value'] }}">
                                                    {{ $item['label'] }}
                                                </option>
                                            @endforeach
                                            {{-- <option value="1">Cash</option>
                                            <option value="2">Credit</option> --}}
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
                                <div class="form-group col-md-3">
                                    <label>Stock No</label>
                                    <input type="text" class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Description</label>
                                    <select class="form-control item-select clear-qty" name="item_id" id="item_id"
                                        onchange="getStockItem()">
                                        <option value="" selected>Select Item</option>
                                        @foreach ($stockItems as $stockItem)
                                            <option value="{{ $stockItem->id }}">
                                                {{ $stockItem->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <select class="form-control select2-location clear-qty" name="location_id"
                                        id="location_id">
                                        <option value="" selected>Select Location</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>U/M</label>
                                    <input type="text" class="form-control" name="uom" id="uom"
                                        placeholder="U/M">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Order Qty</label>
                                    <input type="number" class="form-control" name="quantity"
                                        id="quantity"onkeypress="getItemDiscount()" min="0" step="0.01"
                                        placeholder="Order Qty">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Unit Rate (Rs.)</label>
                                    <input type="number" class="form-control" name="unit_price" id="unit_price"
                                        onkeypress="getItemDiscount()" min="0" step="0.01"
                                        placeholder="Unit Rate (Rs.)" onchange="calculateUnitPrice(this)">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Weight</label>
                                    <input type="number" class="form-control" name="weight" id="weight"
                                        placeholder="weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Item Discount</label>
                                    {{-- <input type="number" class="form-control"
                                        name="item_discount_percentage"onkeyup="getItemDiscount()" min="0"
                                        step="0.01" id="item_discount_percentage" placeholder="Discount"> --}}
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control"
                                            name="item_discount_value"onkeyup="getItemDiscount()" min="0"
                                            step="0.01" id="item_discount_value" placeholder="Discount">
                                        <span class="input-group-text" id="basic-addon2" style="margin:0;padding:0;">
                                            <select name="item_discount_type" id="item_discount_type"
                                                class="form-control form-control-lg" style="height:100%;"
                                                onchange="getItemDiscount()">
                                                <option value="fixed">RS</option>
                                                <option value="percentage">%</option>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Item Discount Amount</label>
                                    <input type="number" class="form-control" placeholder="Item Amount" disabled
                                        id="item_discount_amount">
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
                                        <input type="number" class="form-control js_discount_amount"
                                            name="discount_amount" value="0" placeholder="Discount"
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
                                <button type="button" onclick="onCreateAndViewClick()"
                                    class="btn btn-info btn-fill btn-wd">Create & View</button>
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
        let customerData = {};
        let stockItems = <?php echo json_encode($stockItems); ?>;
        let warehouses = <?php echo json_encode($warehouses); ?>;
        let cartData = [];

        let selectedItemData = {};
        // get the Customer Details from Customer Table
        $(document).ready(function() {
            getItemsTable();
            fetchInvoiceTotal();
        });

        function onCreateAndViewClick() {
            let paymentTerm = $("#payment_terms").val()
            let currentSubTotal = $('#sub_total').val()
            var employee_id = $('#employee_id').val();

            let errorList = [];

            if (Object?.keys(customerData)?.length == 0) {
                errorList.push('The customer field is required')
            }

            if (employee_id == "" || employee_id == null) {
                errorList.push('The sales staff name is required')
            }


            if (customerData?.customer_payment_terms == '{{ $customer::$PAYMENT_TERM_CREDIT }}' &&
                parseFloat(currentSubTotal) > parseFloat(customerData?.customer_credit_limit) && paymentTerm ==
                '{{ $customer::$PAYMENT_TERM_CREDIT }}') {
                errorList.push('Customer credit limit exeeded')
            }

            if (errorList?.length > 0) {
                errorList.forEach(error => {
                    alertDanger(error)
                });
                return
            }
            $('#invoiceCreateForm').submit()
        }

        $('.clear-qty').on('change', function() {
            $('#quantity').val("")
        })

        $('#quantity').on('change', function() {
            const warehouse = $('#location_id').val();
            let quantity = $(this).val();
            // let price = $('#mr_price').val();

            // let total = parseFloat(quantity) * parseFloat(price)
            // $('#mr_total').val(total)

            if (Object.keys(selectedItemData)?.length > 0) {
                const filterCurrentStockData = selectedItemData?.stocks?.find(row => row?.warehouse?.id ==
                    warehouse)
                if (parseFloat(quantity) > parseFloat(filterCurrentStockData?.qty)) {
                    alertDanger(
                        `${filterCurrentStockData?.qty} stock available on ${filterCurrentStockData?.warehouse?.warehouse_name} warehouse`
                        )
                    $(this).val(filterCurrentStockData?.qty)
                }
            }

        })

        function fetchInvoiceTotal() {
            let paymentTerm = $("#payment_terms").val()
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
                    // if (customerData?.customer_payment_terms == '{{ $customer::$PAYMENT_TERM_CREDIT }}' &&
                    //     response.subtotal > customerData?.customer_credit_limit && paymentTerm ==
                    //     '{{ $customer::$PAYMENT_TERM_CREDIT }}') {
                    //     alertDanger("Customer Credit Limit exeeded")
                    // }
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
            var vatRate = 18;
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
                    customerData = response;
                    $('#cus_code').val(response.customer_code);
                    $('#cus_address').val(response.customer_address_line1);
                    $('#cus_vat_no').val(response.customer_vat_number);
                    if (response?.customer_payment_terms == '{{ $customer::$PAYMENT_TERM_CREDIT }}') {
                        $("#payment_terms").find(':not(:selected)').prop('disabled', false);
                        $('#customer_credit_limit_wrapper').css('display', 'block')
                        $('#customer_credit_limit').val(response?.customer_credit_limit)
                        $('#payment_terms').val("")
                        return
                    }
                    $('#customer_credit_limit_wrapper').css('display', 'none')
                    $('#payment_terms').val('cash')
                    $("#payment_terms").find(':not(:selected)').prop('disabled', true);
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

        // get the invoice settings details
        function getInvoiceSettings() {
            var setting_id = $('#setting_id').val();
            var data = {
                setting_id: setting_id
            };
            $.ajax({
                url: "{{ route('invoicesettings.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    $('#invoice_type').val(response.invoice_type);
                    $('#invoice_option').val(response.invoice_option);
                    $('#invoice_category').val(response.invoice_category);
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
            var weight = $('#weight').val();
            var unit_price = $('#unit_price').val();
            var item_discount_amount = $('#item_discount_amount').val() || 0;
            var item_discount_type = $('#item_discount_type').val();
            var item_discount_value = $('#item_discount_value').val() || 0;
            var location_id = $('#location_id').val();
            // var customer_id = $('#customer_id').val();

            let paymentTerm = $("#payment_terms").val()

            let currentSubTotal = $('#sub_total').val()
            let newSubTotal = parseFloat((unit_price * quantity) - parseFloat(item_discount_amount)) + parseFloat(
                currentSubTotal)


            if (customerData?.customer_payment_terms == '{{ $customer::$PAYMENT_TERM_CREDIT }}' &&
                newSubTotal > customerData?.customer_credit_limit && paymentTerm ==
                '{{ $customer::$PAYMENT_TERM_CREDIT }}') {
                alertDanger("Customer Credit Limit exeeded")
                return
            }

            let errorArray = [];

            if (item_id == null || item_id == "") {
                errorArray.push("The description field is required")
            }
            if (quantity == "") {
                errorArray.push("The quantiry field is required")
            }
            if (unit_price == "") {
                errorArray.push("The unit price field is required")
            }
            if (location_id == "") {
                errorArray.push("The warehouse field is required")
            }
            if (errorArray?.length > 0) {
                errorArray.forEach(error => {
                    alertDanger(error);
                });
                return
            }

            const stockItem = stockItems?.find(row => row?.id == item_id)
            const warehouse = warehouses?.find(row => row?.id == location_id)
            let subTotal = parseFloat(unit_price * quantity)

            let data = {
                id: item_id,
                name: stockItem?.description,
                price: unit_price,
                quantity,
                attributes: {
                    weight,
                    stock_no: stockItem?.stock_number,
                    uom: stockItem?.unit,
                    item_discount_type,
                    item_discount_value,
                    item_discount_amount,
                    warehouse_name: warehouse?.warehouse_name,
                    location_id: location_id,
                    sub_total: subTotal,
                    total: subTotal - parseFloat(item_discount_amount),

                },
            }

            $.ajax({
                url: "{{ route('invoices.item.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: data,
                success: function(response) {
                    fetchInvoiceTotal();
                    $('#stock_no').val("");
                    $('#uom').val("");
                    $('#item_id').val("").trigger('change');
                    $('#quantity').val("");
                    $('#weight').val("");
                    $('#unit_price').val("");
                    $('#js_discount_amount').val("");
                    $('#location_id').val("").trigger('change');
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
            $.ajax({
                url: "{{ route('invoices.item.table') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {},
                success: function(response) {
                    $('#items-table').html(response);
                }
            });
        }

        //get item discount amount
        function getItemDiscount() {
            var unit_price = $("#unit_price").val();
            var quantity = $("#quantity").val();
            // var item_discount_percentage = $("#item_discount_percentage").val();
            let itemDiscountType = $('#item_discount_type').val();
            let itemDiscountValue = $('#item_discount_value').val();

            if (unit_price && quantity && itemDiscountValue) {
                let price = unit_price * quantity;
                if (itemDiscountType == "fixed") {
                    $("#item_discount_amount").val(parseFloat(itemDiscountValue)?.toFixed(2))
                    return
                }

                if (itemDiscountType == "percentage") {
                    let discountAmount = (price * itemDiscountValue) / 100
                    $("#item_discount_amount").val(parseFloat(discountAmount)?.toFixed(2))
                    return
                }
                $("#item_discount_amount").val("")
            }
        }

        function removeFromCart(item) {
            $.ajax({
                url: "{{ route('cart.remove') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    id: item?.id
                },
                success: function(response) {
                    fetchInvoiceTotal();
                    getItemsTable()
                }
            });
        }

        $(document).ready(function() {
            $('.item-select').select2({
                placeholder: "Select Item",
            });

            $('.select2-location').select2({
                placeholder: "Select Location",
            });


        });
    </script>
@endpush

@push('styles')
    <style>

    </style>
@endpush
