@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Dispatch Details Creation</h4>
                        <form class="forms-sample" method="POST" action="{{ route('dispatch.store') }}">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Dispatch No</label>
                                    <input type="text" value="{{ $next_number }}" class="form-control"
                                        name="dispatch_no" placeholder="Dispatch No">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Dispatched Date</label>
                                    <input required type="date" class="form-control" value="{{ date('Y-m-d') }}"
                                        name="date" placeholder="Dispatched Date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>FGRN No</label>
                                    <select class="form-control item-select" id="fgrn_no" name="fgrn_no">
                                        <option value="">Select FGRN</option>
                                        @foreach ($finished_goods as $finished_good)
                                            <option value="{{ $finished_good->id }}">{{ $finished_good->fgrn_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dispatch From</label>
                                    <input type="text" class="form-control" id="fgrn_warehouse" readonly
                                        name="fgrn_warehouse" placeholder="Diapatch From">
                                    <input type="hidden" class="form-control" id="fgrn_warehouse_id" readonly
                                        name="fgrn_warehouse_id">
                                </div>
                            </div>

                            <hr>
                            <div id="item_list"></div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total No.of Dispatched Items</label>
                                    <input class="form-control" name="tot_no_dispatch_items"
                                        type="number" id="tot_no_dispatch_items" placeholder="Total Items">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total No.of Dispatched Qty</label>
                                    <input type="number" class="form-control" name="tot_no_dispatch_qty"
                                        id="tot_no_dispatch_qty" placeholder="Total Qty">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total No.of Dispatched Weight</label>
                                    <input type="number" class="form-control" name="tot_no_dispatch_weight"
                                        id="tot_no_dispatch_weight" placeholder="Total Weight">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Fleet No</label>
                                    <select class="form-control" name="fleet_id">
                                        @foreach ($fleets as $fleet)
                                            <option value="{{ $fleet->id }}">{{ $fleet->fleet_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Driver Name</label>
                                    <input type="text" class="form-control" name="driver_name" placeholder="Driver Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Dispatched By</label>
                                    <select class="form-control" name="dispatched_by">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dispatched Date_Time</label>
                                    <input type="datetime-local" class="form-control" name="dispatched_at"
                                        placeholder="Dispatched Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="dispatched_remark"
                                        placeholder="Remark">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Inspected By</label>
                                    <select class="form-control" name="inspected_by">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Inspected Date_Time</label>
                                    <input type="datetime-local" class="form-control" name="inspected_at"
                                        placeholder="Inspected Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="inspected_remark" placeholder="Remark">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Complete Dispatch Creation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let finishedGoodData = <?php echo json_encode($finished_goods); ?>;


            $('#fgrn_no').on('change', function() {
                let fgrnId = $(this).val();
                let finishedGoodItem = finishedGoodData?.find(row => row?.id == fgrnId)
                $('#fgrn_warehouse').val(finishedGoodItem?.warehouse?.warehouse_name);
                $('#fgrn_warehouse_id').val(finishedGoodItem?.warehouse?.id);


                $.ajax({
                    url: "{{ route('dispatch.getFgrnItems') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        fgrn_no: finishedGoodItem?.fgrn_no
                    },
                    success: function(response) {
                        $('#item_list').html(response);
                    }
                });

                $.ajax({
                    url: "{{ route('dispatch.getCalculation') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        fgrn_no: finishedGoodItem?.fgrn_no
                    },
                    success: function(response) {
                        $('#tot_no_dispatch_items').val(response?.tot_no_dispatch_items)
                        $('#tot_no_dispatch_qty').val(response?.tot_no_dispatch_qty)
                        $('#tot_no_dispatch_weight').val(response?.tot_no_dispatch_weight)
                    }
                });
            })

            function onTableItemBlur(e, item, items) {
                let value = e.value == "" ? 0 : parseFloat(e.value)
                if (e.value >= item?.pro_qty) {
                    return e.value = item?.pro_qty
                }

                const total = items?.reduce((acc, curr) => {
                    return acc + parseFloat(curr?.pro_qty)
                }, 0)


                $('#tot_no_dispatch_qty').val((total - parseFloat(item?.pro_qty)) + value)
            }

            function onTableItemWeightBlur(e, item, items) {

                let value = e.value == "" ? 0 : parseFloat(e.value)
                if (e.value >= item?.pro_weight) {
                    return e.value = item?.pro_weight
                }

                const totalWeight = items?.reduce((acc, curr) => {
                    return acc + parseFloat(curr?.pro_weight)
                }, 0)

                $('#tot_no_dispatch_weight').val((totalWeight - parseFloat(item?.pro_weight)) + value)
            }
        </script>
    @endpush
@endsection
