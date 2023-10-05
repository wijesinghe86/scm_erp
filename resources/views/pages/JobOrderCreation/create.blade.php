@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Job Order Creation</h4>
                        <form class="forms-sample" method="POST" action="{{ route('jobordercreation.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Job Order Number</label>
                                    <input type="text" class="form-control" value="{{ $next_job_order_number }}"
                                        name="job_order_no" placeholder="Job Order Number" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Job Order Date</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="jo_date"
                                        placeholder="Job Order Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>PPS Number</label>
                                    <select onchange="" name="pps_no" class="form-control" id="pps_no">
                                        <option selected disabled>Select PPS No</option>
                                        @foreach ($production_plannings as $production_planning)
                                            <option value="{{ $production_planning->id }}">
                                                {{ $production_planning->pps_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>DF Number</label>
                                    <input type="text" class="form-control" name="df_no" id="dfno"
                                        placeholder="DF No">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Plant</label>
                                    <select name="plant_id" class="form-control" id="plant">
                                        <option selected disabled>Select Plant</option>
                                        @foreach ($plants as $plant)
                                            <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Start Date</label>
                                    <input type="datetime-local" class="form-control" name="start_date_time"
                                        placeholder="Start Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>End Date</label>
                                    <input type="datetime-local" class="form-control" name="end_date_time"
                                        placeholder="End Date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Supervisor</label>
                                    <select name="supervisor" class="form-control" id="supervisor">
                                        <option selected disabled>Select</option>
                                        @foreach ($employees as $supervisor)
                                            <option value="{{ $supervisor->id }}">{{ $supervisor->employee_fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="items_table"></div>
                            <button id="jobCreateSubmitBtn" type="submit" class="btn btn-success me-2">Complete Job Order
                                Creation</button>

                            <a href="{{route('jobordercreation.index')}}" class="btn btn-danger" >Go to Jo Order Registry</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            let productionPlanings = <?php echo json_encode($production_plannings); ?>;
            $('#pps_no').on('change', function() {
                let pps_id = $(this).val();
                const productionPlaning = productionPlanings?.find(row => row?.id == pps_id);
                if (productionPlaning) {
                    $('#dfno').val(productionPlaning?.demand_forecasting?.df_no)
                }

                $.ajax({
                    url: "{{ route('jobordercreation.getItems') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        pps_id
                    },
                    success: function(response) {
                        $('.items_table').html(response);
                    }
                });
            })

            function onItemQtyChange(e, availableQty, index) {
                if (e.value > availableQty) {
                    alertDanger(`Available Quantity exceeded on item ${index+1}`)
                    e.value = availableQty;
                    return
                }
            }
        </script>
    @endpush
@endsection
