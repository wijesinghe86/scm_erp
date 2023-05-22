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
                                <div class="form-group col-md-2">
                                    <label>Ref No</label>
                                    <input type="text" class="form-control" name="ref_number" value="SLC">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>SLC Number</label>
                                    <input type="text" class="form-control" name="slc_number"
                                        value="{{ $slc_number }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>SLC Date</label>
                                    <input type="date" class="form-control" name="slc_date">
                                </div>
                            </div>
                            {{-- </div> --}}
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
                                        onchange="getStockItem(this)">
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
                                    <label>Qty</label>
                                    <input type="number" class="form-control" name="iss_qty" id="iss_qty" min="0"
                                        step="0.01" placeholder="Issued Qty">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" name="revd_qty" id="revd_qty" min="0"
                                        step="0.01" placeholder="Revd Qty">
                                </div>
                            </div>
                            {{-- Invoice Items End here --}}
                            <button type="submit" class="btn btn-success me-2" name="button" value="add">Add</button>
                            <br>
                            <br>
                            {{-- Invoice Items table Start here --}}
                            <div class="content table-responsive table-full-width">
                                <table class="table table-success" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <th>Stock No</th>
                                            <th>Description</th>
                                            <th>U/M</th>
                                            <th>Issue Qty</th>
                                            <th>Revd Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (is_array($items))
                                            @foreach ($items as $index => $item)
                                                <tr>
                                                    <td>{{ $item['stock_no'] }}</td>
                                                    <td>{{ $item['description'] }}</td>
                                                    <td>{{ $item['uom'] }}</td>
                                                    <td>{{ $item['iss_qty'] }}</td>
                                                    <td></td>
                                                    <td><a href="{{ route('material_request.delete_item', $index) }}"
                                                            class="btn btn-danger">Delete</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>
                            {{-- Invoice Items table End here --}}
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Issued by</label>
                                    <select class="form-control item-select" name="issued_by" id="issued_by">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Issued Date</label>
                                    <input type="date" class="form-control" name="iss_date" id="iss_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>From Location</label>
                                    <select class="form-control item-select" name="location_id" id="location_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Revd by</label>
                                    <select class="form-control item-select" name="received_by" id="received_by">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Revd Date</label>
                                    <input type="date" class="form-control" name="rec_date" id="rec_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>To Location</label>
                                    <select class="form-control item-select" name="location_id" id="location_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Delivered by</label>
                                    <select class="form-control item-select" name="delivered_by" id="delivered_by">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">
                                                {{ $employee->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Delivered Date</label>
                                    <input type="date" class="form-control" name="delivered_date" id="delivered_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Fleet No</label>
                                    <select class="form-control item-select" name="fleet_id" id="fleet_id">
                                        @foreach ($fleets as $fleet)
                                            <option value="{{ $fleet->id }}">
                                                {{ $fleet->fleet_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks">
                                </div>
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-success me-2">Complete Stock Location Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
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
