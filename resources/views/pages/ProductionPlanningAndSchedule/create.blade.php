@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Production Planning And Schedule Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('productionplanningandschedule.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>PPS No</label>
                        <input type="text" class="form-control" name="pps_no" id="pps_no" value="{{$next_number}}" placeholder="PPS No" >
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Plant</label>
                                    <select class="form-consectionstrol item-select" name="plant">
                                        @foreach ($plants as $plant)
                                            <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                                        @endforeach
                                    </select>
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label>PPS Date</label>
                        <input type="date" class="form-control" name="pps_date" id="pps_date" placeholder="PPS Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Plant</label>
                        <select class ="form-control plant-select" name="plant" id="plant" placeholder="Plant" >
                            <option value="" selected disabled>Select Plant</option>
                                  @foreach ($plants as $plant)
                                      <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                                  @endforeach
                              </select>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Production Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Production Start Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Production End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Production End Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>DF No</label>
                        <select class ="form-control df_input" name="df_id" id="df_id" placeholder="DF NO" >
                            <option value="df_id" selected disabled>Select DF No</option>
                                  @foreach ($df_list as $row)
                                      <option value="{{ $row->id }}">{{ $row->df_no }}</option>
                                  @endforeach
                              </select>
                    </div>
                </div>
                <div class="items_table"></div>

                 <button type="submit" class="btn btn-success me-2">Complete Production Planning And Schedule</button>

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
            $('.plant-select').select2({
                placeholder: "Select Plant",
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // alert("ss");
            $('.items_table');
        });
        $(".df_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/ProductionPlanningAndSchedule/get-items?df_id=' + id, function() {

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
