@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Finished Goods Entry Note</h4>
                        <form class="forms-sample" method="POST" action="{{ route('finishedgoods.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    <input value="{{ date('Y-m-d') }}" type="date" class="form-control" name="date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>FGRN No</label>
                                    <input type="text" class="form-control" value="{{ $next_number }}" name="fgrn_no"
                                        placeholder="FGRN_No" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse</label>
                                    <select class="form-control item-select" name="warehouse_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>RMI No</label>
                                    <select class="form-control item-select" name="rmi_no" id="rmi_no">
                                        <option value="">Select RMI</option>
                                        @foreach ($rmi_data as $rmi)
                                            <option value="{{ $rmi->id }}">{{ $rmi->rmi_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Production Start Date Time</label>
                                    <input type="datetime-local" class="form-control" name="pro_start_date_time">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Production End Date Time</label>
                                    <input type="datetime-local" class="form-control" name="pro_end_date_time">
                                </div>   
                            </div>
                            <hr>
                            <h5>Finish Product Entry</h5>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>RMI Item Stock No</label>
                                    <input readonly type="text" class="form-control" id="rmi_item_stock_number"
                                        placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>RMI Item</label>
                                    <select id="rmi_item_id" class="form-control item-select" name="rmi_item[]" multiple = "multiple">
                                        <option selected disabled>Select Request Item</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>RMI Qty</label>
                                    <input readonly type="text" class="form-control" id="rmi_qty" placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>RMI Weight</label>
                                    <input readonly type="text" class="form-control" id="rmi_weight" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Finish Good Item</label>
                                    <select id="pro_item_id" class="form-control item-select">
                                        <option selected disabled>Select Finish Good Item</option>
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Finish Good Qty</label>
                                    <input type="number" class="form-control" id="pro_qty" placeholder="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Finish Good Weight</label>
                                    <input type="number" class="form-control" id="pro_weight" placeholder="">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Batch Number</label>
                                    <input type="text" class="form-control" id="batch_no" placeholder="">
                                </div>
                            </div>
                            <button onclick="addToFinishGoodTable()" type="button" class="btn btn-success me-2"
                                name="button" value="add">Add Finish
                                Good Enty</button>
                            <br>
                            <div id="finish_good_item_table"></div>
                            <hr>
                            <h5>Wastage Entry</h5>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock No</label>
                                    <input type="text" readonly class="form-control" id="wastage_stock_no">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <select class="form-control item-select" id="wastage_stock_item_id">
                                        <option value="">Select Item</option>
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>UOM</label>
                                    <input type="text" readonly class="form-control" id="wastage_uom">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" id="wastage_qty">
                                </div>
                            </div>
                            <button onclick="addToWastageTable()" type="button" class="btn btn-success me-2"
                                name="button" value="add">Add
                                Wastage</button>
                            <br>
                            <br>
                            <div id="wastage_item_table"></div>
                            <br>
                            <hr>
                            <br>
                            @php
                                
                            @endphp
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Issued Weight</label>
                                    <input type="text" readonly class="form-control" name="tot_issued_weight"
                                        id="tot_issued_weight">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Production Qty</label>
                                    <input type="text" readonly class="form-control" name="tot_pro_qty"
                                        id="tot_pro_qty">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Production Weight</label>
                                    <input type="text" readonly class="form-control" name="tot_pro_weight"
                                        id="tot_pro_weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Wastage</label>
                                    <input type="text" readonly class="form-control" name="tot_waste" id="tot_waste">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remaining Raw Materials</label>
                                    <input type="text" readonly class="form-control" name="remaining" id="remaining">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Complete Finished Goods</button>
                            <a href="{{ route ('finishedgoods.index') }}" class="btn btn-success me-2">Go to FGRN Registry</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let rmiData = <?php echo json_encode($rmi_data); ?>;
            let stockItems = <?php echo json_encode($stock_items); ?>;


            let selectedRmiItems = [];


            $(document).ready(function() {
                getTotalCalcuations()
                viewCartFinishGoodTable();
                viewWastageTabel();
                $('.item-select').select2({
                    placeholder: "Select Item",
                });
            });

            $('#rmi_no').on('change', function() {
                let rmi_id = $(this).val();
                const rmiDataItem = rmiData?.find(row => row?.id == rmi_id)
                $('#rmi_item_stock_number').val("");
                $('#rmi_qty').val("");
                $('#rmi_weight').val("");
                $('#pro_item_id').val("").trigger('change');
                $('#pro_qty').val("");
                $('#pro_weight').val("");
                $('#batch_no').val("");
                $.ajax({
                    url: "{{ route('finishedgoods.getRmiItems') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        rmi_no: rmiDataItem?.rmi_no
                    },
                    success: function(response) {
                        viewCartFinishGoodTable()
                        viewWastageTabel()
                        selectedRmiItems = response;
                        $('#rmi_item_id').find('option').remove().end()
                        $('#rmi_item_id').append(
                            '<option selected disabled>Select Item</option>');
                        response.forEach(element => {
                            $('#rmi_item_id').append('<option  value="' + element.id +
                                '">' + element?.semi_product_serial_no + '</option>');
                        })
                    }
                });
            })
            $('#rmi_item_id').on('change', function() {
                const rmi_id_array =  $('#rmi_item_id').val();
                let sum = rmi_id_array.reduce(myFunction);

        document.getElementById("rmi_qty").innerHTML = sum;

function myFunction(total, value, index, array) {
  return total + value;
}

                let rmi_item_id = $(this).val();
                let rmiItemData = selectedRmiItems?.find(row => row?.id == rmi_item_id)
                $('#rmi_item_stock_number').val(rmiItemData?.semi_product_item?.semi_product_stock_item?.stock_number);
                // $('#rmi_qty').val(rmiItemData?.semi_product_qty);
                // $('#rmi_weight').val(rmiItemData?.semi_product_weight);
                console.log($(this).val())
            })

            function addToFinishGoodTable() {
                let rmi_item_stock_number = $('#rmi_item_stock_number').val();
                let rmi_item_id = $('#rmi_item_id').val();
                let rmi_qty = $('#rmi_qty').val();
                let rmi_weight = $('#rmi_weight').val();
                let pro_item_id = $('#pro_item_id').val();
                let pro_qty = $('#pro_qty').val();
                let pro_weight = $('#pro_weight').val();
                let batch_no = $('#batch_no').val();

                $.ajax({
                    url: "{{ route('finished_goods.addToFinishGoodTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        rmi_item_stock_number,
                        rmi_item_id,
                        rmi_qty,
                        rmi_weight,
                        pro_item_id,
                        pro_qty,
                        pro_weight,
                        batch_no,
                    },
                    success: function(response) {
                        alertSuccess("Item added successfully")
                        viewCartFinishGoodTable();
                        $('#pro_item_id').val("").trigger('change');
                        $('#pro_qty').val("");
                        $('#pro_weight').val("");
                        $('#batch_no').val("");
                    },
                    error: function(data) {
                        $.each(data.responseJSON?.errors, function(key, value) {
                            alertDanger(value);
                        });
                    }
                });
            }

            function removeFromFinishGoodTable(e, pro_stock_no, rmi_item_stock_number, semi_product_serial_no) {
                $.ajax({
                    url: "{{ route('finishedgoods.removeFromFinishGoodTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        rmi_item_stock_number,
                        semi_product_serial_no,
                        pro_stock_no,
                    },
                    success: function(response) {
                        alertSuccess("Item removed successfully")
                        viewCartFinishGoodTable();
                    }
                });
            }


            function viewCartFinishGoodTable() {
                $.ajax({
                    url: "{{ route('finishedgoods.getFinishGoodTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {},
                    success: function(response) {
                        getTotalCalcuations()
                        $('#finish_good_item_table').html(response)
                    }
                });
            }


            $('#wastage_stock_item_id').on('change', function() {
                let wastage_stock_item_id = $(this).val();
                const stockItem = stockItems?.find(row => row?.id == wastage_stock_item_id)
                $('#wastage_stock_no').val(stockItem?.stock_number);
                $('#wastage_uom').val(stockItem?.unit);

            })



            function addToWastageTable() {
                let wastage_stock_no = $('#wastage_stock_no').val()
                let wastage_stock_item_id = $('#wastage_stock_item_id').val()
                let wastage_qty = $('#wastage_qty').val()
                $.ajax({
                    url: "{{ route('finishedgoods.addToWastageTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        wastage_stock_no,
                        wastage_stock_item_id,
                        wastage_qty,
                    },
                    success: function(response) {
                        alertSuccess("Item added successfully")
                        $('#wastage_stock_no').val("")
                        $('#wastage_stock_item_id').val("").trigger('change')
                        $('#wastage_qty').val("")
                        viewWastageTabel();
                    },
                    error: function(data) {
                        $.each(data.responseJSON?.errors, function(key, value) {
                            alertDanger(value);
                        });
                    }
                });
            }

            function removeFromWastageTable(e, index) {
                $.ajax({
                    url: "{{ route('finishedgoods.removeFromWastageTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        index
                    },
                    success: function(response) {
                        alertSuccess("Item removed successfully")
                        viewWastageTabel();
                    }
                });
            }

            function viewWastageTabel() {
                $.ajax({
                    url: "{{ route('finishedgoods.getWastageTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {},
                    success: function(response) {
                        getTotalCalcuations()
                        $('#wastage_item_table').html(response)
                    }
                });
            }



            function getTotalCalcuations() {
                $.ajax({
                    url: "{{ route('finishedgoods.getTotalCalculations') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {},
                    success: function(response) {
                        $('#tot_issued_weight').val(response?.tot_issued_weight)
                        $('#tot_pro_qty').val(response?.tot_pro_qty)
                        $('#tot_pro_weight').val(response?.tot_pro_weight)
                        $('#tot_waste').val(response?.tot_waste)
                        $('#remaining').val(response?.remaining)
                    }
                });
            }
        </script>
    @endpush
@endsection
