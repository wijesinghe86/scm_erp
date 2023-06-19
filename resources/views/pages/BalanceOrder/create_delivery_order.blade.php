@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Delivery Order from Balance Order
                            {{ $balance_order->balance_order_no }}</h4>
                        <table class="table table-bordered" id="tbl_finishedgoods">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>STOCK NO</td>
                                    <td>DESCRIPTION</td>
                                    <td>U/M</td>
                                    <td>BALANCED QTY</td>
                                    <td>QUANTITY</td>
                                    <td>LOCATION</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($balance_order->items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->stock_no }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->uom }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>
                                            <input type="number" id="newQuantity-{{ $key }}" class="form-control"
                                                value="{{ $item->qty }}" name="items[{{ $item->id }}][qty]"
                                                placeholder="Quantity">
                                        </td>
                                        <td>
                                            <select value="{{ $item->location_id }}" class="form-control item-select"
                                                name="location_id" id="location_id-{{ $key }}">
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">
                                                        {{ $warehouse->warehouse_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary "
                                                onclick="addToCart({{ $item }}, {{ $key }})">Add
                                                To Cart</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h5 class="card-title">Cart</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>STOCK NO</td>
                                    <td>DESCRIPTION</td>
                                    <td>U/M</td>
                                    <td>QTY</td>
                                    <td>LOCATION</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody id="cartList">

                            </tbody>
                        </table>

                        </table>
                        <button onclick="onSubmit()" class="btn btn-success me-2">Create Delivery Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {});
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
            if ((parseFloat(quantitySum) + parseFloat(qunantity)) > item?.qty) {
                return alert("Quantity is grater than availanble quantity")
            }

            $(`#newQuantity-${index}`).val(item?.qty - (parseFloat(quantitySum) + parseFloat(qunantity)))

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
            $('#quantity_id').val(qty)
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
                        <td>${item?.qty}</td>
                        <td>${locationName[0].warehouse_name}</td>
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
            if (cart?.length == 0) {
                return alert("No items selected in cart")
            }
            let data = {
                cart
            }
            $.ajax({
                url: "{{ route('balanceorder.delivery_order_create', $balance_order->id) }}",
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
    </script>
@endpush
