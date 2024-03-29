@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="header">
                            <h4 class="title"> Delivery Order {{ $delivery_order->delivery_order_no }} </h4>
                            <div class="card-body">
                                <div class="content">
                                    <form id="issueDeliveryOrderForm" method="POST"
                                        action="{{ route('deliveryorders.issueStore', $delivery_order->id) }}">
                                        @csrf
                                        <table class="table table-bordered" id="tbl_finishedgoods">
                                            <thead>
                                                <tr>
                                                    <td></td>
                                                    <td>STOCK NO</td>
                                                    <td>DESCRIPTION</td>
                                                    <td>U/M</td>
                                                    <td>ORDERED QTY</td>
                                                    <td>BALANCE QTY</td>
                                                    <td>ISSUED QTY</td>
                                                    <td>STOCK IN HAND</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($delivery_order->items as $key => $item)
                                                    @php
                                                        $location_id = $item->location;
                                                        $filterStockData = [];
                                                        foreach ($item->stock_item->stocks as $key => $stock) {
                                                            if ($stock->warehouse_id == $location_id) {
                                                                array_push($filterStockData, $stock);
                                                            }
                                                        }
                                                        
                                                        $stock = 0;
                                                        if (count($filterStockData) > 0) {
                                                            $stock = reset($filterStockData)['qty'];
                                                        }
                                                        
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->stock_no }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->uom }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>{{ $item->available_qty }}</td>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                name="items[{{ $item->id }}][issue_quantity]"
                                                                value="{{ $item->qty }}" placeholder="Issue Quantity">
                                                            <input style="display:none" value="{{ $stock }}"
                                                                name="items[{{ $item->id }}][available_stock]" />
                                                            <input style="display:none" value="{{ $item->qty }}"
                                                                name="items[{{ $item->id }}][order_qty]" />
                                                            <input style="display:none" value="{{ $key + 1 }}"
                                                                name="items[{{ $item->id }}][index]" />
                                                        </td>
                                                        <td>{{ $stock }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                       <br>
                                       <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Vehicle No</label>
                                            <input type="text" class="form-control" name="vehicle_no" id="vehicle_no">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Driver Name</label>
                                            <input type="text" class="form-control" name="driver_name" id="driver_name">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>NIC No</label>
                                            <input type="text" class="form-control" name="nic_no" id="nic_no">
                                        </div>
                                    </div>
                                        <div style="display:flex;justify-content: flex-end; align-items: center; gap:1rem;">
                                            <a href="{{ route('deliveryorders.view', $delivery_order->id) }}"
                                                class="btn btn-danger">D/O Registry</a>
                                            <button onclick="validateBeforeSubmit()" type="button"
                                                class="btn btn-success">Issue Delivery</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let itemList = <?php echo json_encode($delivery_order->items); ?>;

            function validateBeforeSubmit() {
                let data = $('#issueDeliveryOrderForm').serializeArray()

                let errorArray = [];

                itemList.forEach(item => {
                    const filterData = data?.filter(row => {
                        return row.name.includes(`items[${item?.id}]`)
                    })
                    const mappedData = filterData?.map(row => row?.value)
                    if (parseFloat(mappedData[0]) > parseFloat(mappedData[2])) {
                        errorArray.push(`The item ${mappedData[3]} exceed ordered quantity`)
                    }
                    if (parseFloat(mappedData[0]) > parseFloat(mappedData[1])) {
                        errorArray.push(`The item ${mappedData[3]} exceed stock in hand`)
                    }
                });

                if (errorArray?.length > 0) {
                    errorArray.forEach(error => {
                        alertDanger(error)
                    });
                    return
                }
                $('#issueDeliveryOrderForm').submit();
            }
        </script>
    @endpush
@endsection
