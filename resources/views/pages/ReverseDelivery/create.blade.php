@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Urgent Delivery Order</h4>
                        <form class="forms-sample" method="POST" action="{{ route('reverse_delivery.store') }}">
                            @csrf
                            <div style="display:none; position:absolute; top:0.5cm; bottom:-20px; left:28cm; right:20px; width: 400px;"
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
                            <br>
                            <div class="row">
                                    <div class="form-group col-md-2">
                                    <label>Delivery Order No</label>
                                    <input type="text" class="form-control" name="issue_no" placeholder="D/O No"
                                      value="{{ $next_number }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="issued_date" value="{{ date('Y-m-d') }}" readonly
                                        placeholder="Issued date">
                                </div>

                                </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                    <input type="text" readonly class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <select class="form-control item-select" name="stock_item"  id="stock_item"
                                        onchange="itemOnChange(this)">
                                        <option selected disabled>Select Item</option>
                                        @foreach ($stockItems as $item)
                                            <option value="{{ $item->id }}">{{ $item->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>U/M</label>
                                    <input type="text" readonly class="form-control" name="uom" id="uom"
                                        placeholder="U/M">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Issue Qty</label>
                                    <input type="number" class="form-control" name="issued_qty" id="issued_qty"
                                        placeholder="Issue Qty">
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success me-2" name="button" value="add">Add</button>

                            {{-- <button class="btn btn-danger">Cancel</button> --}}
                            {{-- devide the page and table --}}
                            <hr/>

                            <table class="table bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Stock No</th>
                                        <th>Description</th>
                                        <th>U/M</th>
                                        <th>Issued Qty</th>
                                         <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (is_array($items))
                                        @foreach ($items as $index => $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $item['stock_no'] }}</td>
                                                <td>{{ $item['description'] }}</td>
                                                <td>{{ $item['uom'] }}</td>
                                                <td>{{ $item['issued_qty'] }}</td>
                                                <td><a href="{{ route('reverse_delivery.delete_item', $index) }}"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Customer Name</label>
                                    <select class="form-control item-select" name="customer_id"  id="customer_id" >
                                        <option>Select Item</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <select class="form-control item-select" name="warehouse_id" id="warehouse_id">
                                        <option value="">Select Item</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="form-group col-md-3">
                                <label>Issued By</label>
                                <select class="form-control emp-select" name="issued_by" value="{{ old('issued_by') }}">
                                    {{-- <option selected disabled>Select</option> --}}
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}"> {{ $employee->employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <button type="submit" class="btn btn-success me-2" name="button" value="Issue Items">Complete
                               </button>
                               {{-- <a target="_blank" href="{{ route('reverse_delivery.print', ['urgent_delivery_id' => $urgent_delivery->id]) }}"
                                type="submit" class="btn btn-secondary mr-5" name="button"> Print</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@push('scripts')
    <script>
    let stockItems = <?php echo json_encode($stockItems); ?>;

        $(document).ready(function() {
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });

        $(document).ready(function() {
            $('.emp-select').select2({
                placeholder: "Select",
            });
        });

        $('#stock_item').on('change', function() {
                let stockItemId = $(this).val();
                let stockItem = stockItems?.find(row => row?.id == stockItemId);
                $('#stock_no').val(stockItem?.stock_number)
                $('#uom').val(stockItem?.unit)

                $('#stockView').hide();

                if (stockItem?.stocks?.length > 0) {
                    $('#stockViewItems').find('tr').remove().end()
                    stockItem?.stocks.forEach(element => {
                        $('#stockViewItems').append(
                            `<tr><td>${element?.warehouse?.warehouse_name}</td><td align="right" >
                                ${element?.qty}</td></tr>`
                        )
                    })
                    $('#stockView').show();
                }
            })



    </script>
@endpush

@push('styles')
    <style>
        .select2-container .select-selection--single {
            height: 46px;
        }
    </style>
@endpush
