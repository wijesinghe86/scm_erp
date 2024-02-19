@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title">Customer Return Entry</h4>
                        <br>
                        <form id="customerReturn" action="{{ route('returns.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Customer Code</label>
                                <input type="text" class="form-control" value="{{ $customer_code }}" id="customer_code"
                                    name="customer_code" placeholder="Customer Code" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Customer Name</label>
                                <select class="form-control customer-select" name="customer_id" id="customer_id">
                                    <option value="">-</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Invoice Date</label>
                                <input type="date" class="form-control" name="invoice_date" id="invoice_date">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Invoice No</label>
                                <select class="form-control invoice_input" name="invoice_number" id="invoice_number"
                                    placeholder="Invoice No">
                                    <option value="" selected disabled>Select Invoice No</option>
                                    @foreach ($invoices as $row)
                                        <option value="{{ $row->invoice_number }}">{{ $row->invoice_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>DO No</label>
                                <select class="form-control invoice_input" name="delivery_order" id="delivery_order"
                                    placeholder="Invoice No">
                                    <option value="" selected disabled>Select Delivery Order No</option>
                                    @foreach ($delivery_orders as $row)
                                        <option value="{{ $row->id }}">{{ $row->delivery_order_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Payment Method</label>
                                <select name="payment_method" class="form-control item-select" id="payment_method">
                                    <option selected disabled>Select Terms</option>
                                    <option value="1">N/A</option>
                                    <option value="2">Cash</option>
                                    <option value="3">Credit</option>
                                </select>
                            </div>
                        </div>

                        @if ($delivery_order)
                            <div class="table-responsive">
                            <table class="table table-bordered" id="tbl_finishedgoods">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>STOCK NO</td>
                                        <td>DESCRIPTION</td>
                                        <td>U/M</td>
                                        <td>UNIT PRICE</td>
                                        <td>ISSUED QTY</td>
                                        <td>RETURNABLE QTY</td>
                                        <td>RETURNED QTY</td>
                                        <td>LOCATION</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($delivery_order->items as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->stock_no }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td>{{ $item->unit_price }}</td>
                                            <td>{{ $item->issued_qty }}</td>
                                            <td>{{ $item->issued_qty - $item->returned_qty }}</td>
                                            <td>
                                                <input type="number" id="newQuantity-{{ $key }}"
                                                    class="form-control" value="{{ $item->issued_qty - $item->returned_qty }}"
                                                    name="items[{{ $item->id }}][newQuantity]" placeholder="Quantity">
                                            </td>
                                            <td>
                                                <select class="form-control item-select" name="location_id"
                                                    id="location_id-{{ $key }}">
                                                    @foreach ($warehouses as $warehouse)
                                                        <option
                                                            {{ $item->location_id == $warehouse->id ? 'selected' : '' }}
                                                            value="{{ $warehouse->id }}">
                                                            {{ $warehouse->warehouse_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary "
                                                    onclick="addToCart({{ $item }},{{ $key }})">Add
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            <br>

                            <h5 class="card-title">Return List</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>STOCK NO</td>
                                        <td>DESCRIPTION</td>
                                        <td>U/M</td>
                                        <td>LOCATION</td>
                                        <td>UNIT PRICE</td>
                                        <td>QTY</td>
                                        <td>TOTAL</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="cartList">

                                </tbody>
                            </table>
                            </table>

                            <button onclick="onSubmit()" class="btn btn-success me-2">Create Return</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const cartList = document.getElementById('cartList');
        let warehouseData = <?php echo json_encode($warehouses); ?>;

        let cart = [];

        function addToCart(item, index) {
            var location_id = $(`#location_id-${index}`).val();
            var qunantity = $(`#newQuantity-${index}`).val();
            let mappedData = {
                ...item,
                location_id,
                qty: qunantity,
                sub_total: parseFloat(item.unit_price) * parseFloat(qunantity),
                total: parseFloat(item.unit_price) * parseFloat(qunantity),
            }

            const quantitySum = cart.filter(row => row?.id == item?.id).reduce((acc, curr) => {
                return acc + parseFloat(curr.qty)
            }, 0)
            if (qunantity == 0) {
                return
            }
            if ((parseFloat(quantitySum) + parseFloat(qunantity) + parseFloat(item?.returned_qty)) > item?.issued_qty) {
                return alert("Quantity is grater than availanble quantity")
            }

            $(`#newQuantity-${index}`).val(item?.issued_qty - (parseFloat(quantitySum) + parseFloat(qunantity)))

            const filteredItem = cart.filter(row => row?.location_id == location_id && row?.stock_no == item?.stock_no)

            if (filteredItem?.length > 0) {
                let cartItem = filteredItem[0]
                let indexOf = cart.findIndex(row => row?.location_id == location_id && row?.stock_no == item?.stock_no)
                let newItem = {
                    ...cartItem,
                    qty: parseFloat(cartItem.qty) + parseFloat(qunantity),
                    sub_total: parseFloat(cartItem.unit_price) * (parseFloat(cartItem.qty) + parseFloat(qunantity)),
                    total: parseFloat(cartItem.unit_price) * (parseFloat(cartItem.qty) + parseFloat(qunantity)),
                }
                cart.splice(indexOf, 1, newItem)
                renderData()
                return
            }
            cart.push(mappedData)
            renderData()
            return
        }
       
        function onRemoveFromCart(qty, index) {
            // $('#quantity_id').val(qty)
            cart.splice(index, 1);
            renderData()
        }

        function renderData() {

            while (cartList.firstChild) {
                cartList.removeChild(cartList.firstChild);
            }
            cart.forEach((item, index) => {
                let locationName = warehouseData.filter(row => row?.id == item?.location_id)

                let tableRow =
                    `<tr>
            <td></td>
            <td>${item?.stock_no}</td>
            <td>${item?.description}</td>
            <td>${item?.uom}</td>
            <td>${locationName[0].warehouse_name}</td>
            <td>${item?.unit_price}</td>
            <td>${item?.qty}</td>
            <td>${item?.total}</td>
            <td>
                <button onclick="onRemoveFromCart(${item?.qty},${index})" class="btn btn-default" >
                    <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                </button>
            </td>
            </tr>`;
                cartList.innerHTML += tableRow;
            });
        }

        function onSubmit() {
            const paymentMethod = $("#payment_method").val()
            if (cart?.length == 0) {
                return alert("No items selected in return cart")
            }

            if (paymentMethod == null) {
                return alert("the Payment method is required")
            }

            let data = {
                cart,
                delivery_order: $("#delivery_order").val(),
                payment_method: paymentMethod
            }
            $.ajax({
                url: "{{ route('returns.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: data,
                success: function(response) {
                    window.location.href = response
                }
            });
        }
        $(document).ready(function() {
            let customer = <?php echo json_encode($customer_data); ?>;
            let invoice_number = <?php echo json_encode($invoice_number); ?>;
            let delivery_order_no = <?php echo json_encode($delivery_order_no); ?>;
            if (customer) {
                $("#customer_id").val('{{ optional($customer_data)->id }}')
            }
            if (invoice_number) {
                $("#invoice_number").val('{{ $invoice_number }}')
            }
            if (delivery_order_no) {
                $("#delivery_order").val('{{ $delivery_order_no }}')
            }
            $("#invoice_date").val('{{ $invoice_date }}')
        });

        let selectedDeliveryOrder = {};

        let customerId = "{{$customer_data ? $customer_data->id : ""}}";
        let invoiceDate = "{{ $invoice_date }}";
        let invoiceNumber = "{{ $invoice_number }}"
        let deliveryOrderId = "{{ $delivery_order_no }}"

        $("#customer_id").change(function() {
            customerId = $(this).val();
            window.location.href =
                `/returns/new?customer_id=${customerId}&invoice_date=${invoiceDate}&invoice_number=${invoiceNumber}&delivery_order_no=${deliveryOrderId}`
        });

        $("#invoice_date").change(function() {
            invoiceDate = $(this).val();
            window.location.href =
                `/returns/new?customer_id=${customerId}&invoice_date=${invoiceDate}&invoice_number=${invoiceNumber}&delivery_order_no=${deliveryOrderId}`
        });

        $("#invoice_number").change(function() {
            invoiceNumber = $(this).val();
            window.location.href =
                `/returns/new?customer_id=${customerId}&invoice_date=${invoiceDate}&invoice_number=${invoiceNumber}&delivery_order_no=${deliveryOrderId}`
        });

        $("#delivery_order").change(function() {
            deliveryOrderId = $(this).val();
            window.location.href =
                `/returns/new?customer_id=${customerId}&invoice_date=${invoiceDate}&invoice_number=${invoiceNumber}&delivery_order_no=${deliveryOrderId}`
        });

        $(document).ready(function() {
            $('.customer-select').select2({
                placeholder: "Select Customer",
            });
        });     
</script>
@endpush
