@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Damage Return Entry</h2>
                        <br>
                        <form class="forms-sample" method="POST" action="{{ route('damage_return.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Transaction No</label>
                                    <input type="text" class="form-control" name="dr_no" id="dr_no" value="{{ $next_number }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Date</label>
                                    <input value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                        name="damage_date" id="damage_date" placeholder="date">
                                </div>
                                <div class="form-group col-md-3">
                                <label>Reference No</label>
                                <select class="form-control ref-select" name="reference_no" id="reference_no">
                                    <option value="">Select</option>
                                    @foreach ($delivery_orders as $delivery_order)
                                        <option value="{{ $delivery_order->id }}">{{ $delivery_order->delivery_order_no }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Warehouse</label>
                                    <select class="form-control warehouse-select" name="warehouse" id="warehouse">
                                        <option value="">Select</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <h4><strong>Original Item Details</strong></h4>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Stock Number</label>
                                    <input readonly type="text" class="form-control" name="ori_stock_number" id="ori_stock_number">
                                    @if($errors->has('stock_number'))
                                        <div class="error">{{ $errors->first('stock_number') }}</div>
                                        @endif
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Description</label>
                                    <select style="width: 100%;" class="form-control item-select" name="ori_stock_id" id="ori_stock_id" onchange="itemOnChange(this)">
                                        <option value="">Select Item</option>
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Unit</label>
                                    <input readonly type="text" class="form-control" name="ori_stock_unit" id="ori_stock_unit">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label style="font-size: 14px">Reason for Damage</label>
                                    <input type="text" class="form-control" name="reason" id="reason"
                                        placeholder="reason" >
                                </div>
                            </div>
                            <br>
                            <hr>
                            <h4><strong>Damage Item Details</strong></h4>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Stock Number</label>
                                    <input readonly type="text" class="form-control" name="dmg_stock_number" id="stock_number">
                                    @if($errors->has('stock_number'))
                                        <div class="error">{{ $errors->first('stock_number') }}</div>
                                        @endif
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Description</label>
                                    <select style="width: 100%;" class="form-control item-select" name="dmg_stock_id" id="dmg_stock_id" onchange="itemOnChange(this)">
                                        <option value="">Select Item</option>
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Unit</label>
                                    <input readonly type="text" class="form-control" name="stock_unit" id="stock_unit">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control" name="qty" id="qty"
                                        placeholder="Quantity">
                            </div>
                        </div>
                            {{-- <button name="addAnother" value="0" type="submit" class="btn btn-success me-2">Create</button> --}}
                            <button name="addAnother" value="1" type="submit" class="btn btn-success me-2">Create And Add another</button>
                            <a href="{{ route('damage_return.index') }}" class="btn btn-primary me-2"> Back </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // viewItemTable()
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });

        $(document).ready(function() {
        // viewItemTable()
        $('.ref-select').select2({
            placeholder: "Select Reference",
        });
    });

    // $(document).ready(function() {
    //         // viewItemTable()
    //         $('.ori-item-select').select2({
    //             placeholder: "Select Item",
    //         });
    //     });
        </script>


<script>
    $(document).ready(function() {
        // viewItemTable()
        $('.warehouse-select').select2({
            placeholder: "Select Warehouse",
        });




        $('.warehouse-select').val(warehouse).trigger('change')

    });
</script>


    <script type="application/javascript">
     var stock_items = '{!! $stock_items->toJson()!!}';
        stock_items = JSON.parse(stock_items);


        function itemOnChange(elem) {


            const selectedItem = stock_items?.find(row => row?.id == elem.value)


          document.getElementById("stock_number").value = selectedItem.stock_number;
          document.getElementById("stock_unit").value = selectedItem.unit;
          document.getElementById("ori_stock_number").value = selectedItem.stock_number;
          document.getElementById("ori_stock_unit").value = selectedItem.unit;


        }

        </script>
        @endpush




