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
                        <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Job Order Date</label>
                        <input type="date" class="form-control" name="job_order_Date" placeholder="Job Order Date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>PPS Number</label>
                        <select name="pps_no" class="form-control" id="pps_no">
                        <option selected disabled>Select PPS No</option>
                        @foreach ($pps as $proplans)
                            <option value="{{ $proplans->id }}">{{ $proplans->pps_no }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>DF Number</label>
                        <input type="text" class="form-control" name="dfno" placeholder="DF No">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Plant</label>
                        <select name="plant" class="form-control" id="plant">
                            <option selected disabled>Select Plant</option>
                            @foreach($plants as $plant)
                            <option value="{{ $plant->id }}">{{ $plant->plant_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="end_date" placeholder="End Date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Supervisor</label>
                        <select name="supervisor" class="form-control" id="supervisor">
                            <option selected disabled>Select</option>
                            @foreach ($employees as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->employee_fullname }}</option>
                            @endforeach
                        </select>
                   </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Complete Job Order Creation</button>

            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
