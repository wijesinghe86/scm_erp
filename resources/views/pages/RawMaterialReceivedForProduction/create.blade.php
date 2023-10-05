@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Material Received For Production</h4>
                        <form class="forms-sample" method="POST" action="{{ route('rawmaterial_received_for_production.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>MRC No</label>
                                    <input required type="text" class="form-control" value="{{ $next_number }}"
                                        name="rma_no" placeholder="RMA No" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Received By</label>
                                    <select required class="form-control" name="received_by">
                                        <option value="" selected>Select Received By</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Received Warehouse</label>
                                    <select required class="form-control" name="warehouse_code">
                                        <option value="" selected>Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Received Date Time</label>
                                    <input required type="datetime-local" class="form-control" id="received_date_time"
                                        name="received_date_time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>RMI No</label>
                                    <select required class="form-control item-select" id="rmi_no" name="rmi_no">
                                        <option value="" selected>Select RMI</option>
                                        @foreach ($rmi_data as $rmi)
                                            <option value="{{ $rmi->rmi_no }}">{{ $rmi->rmi_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Issued By</label>
                                    <input readonly type="text" class="form-control" name="issued_by" id="issued_by">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Issued Warehouse</label>
                                    <input readonly type="text" class="form-control" name="issued_warehouse"
                                        id="issued_warehouse">
                                </div>
                            </div>

                            <br>
                            <div id="item_cart"></div>
                            <br>

                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            <a href="{{route('rawmaterial_received_for_production.index')}}" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const rmiData = <?php echo json_encode($rmi_data); ?>;
            $(document).ready(function() {
                $('.item-select').select2({
                    placeholder: "Select Item",
                });
            });


            $('#rmi_no').on('change', function() {
                let rmi_no = $(this).val();
                console.log(rmiData);
                const rmiItem = rmiData?.find(row => row?.rmi_no == rmi_no);
                $('#issued_by').val(rmiItem?.created_by?.name);
                $('#issued_warehouse').val(rmiItem?.warehouse?.warehouse_name);

                $.ajax({
                    url: "{{ route('rawmaterial_received_for_production.getItemList') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        rmi_no
                    },
                    success: function(response) {
                        $('#item_cart').html(response)
                    }
                });
            })
        </script>
    @endpush
@endsection
