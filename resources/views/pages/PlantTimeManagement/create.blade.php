@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Plant Time Management Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('planttimemanagement.store') }}">
              @csrf
              <br><br>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Production Planning Schedule Number</label>
                        <input type="text" class="form-control" name="production_planning_schedule_number" placeholder="Production Planning Schedule Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Job Order Number</label>
                        <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Plant Number</label>
                        <input type="text" class="form-control" name="plant_number" placeholder="Plant Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Plant Name</label>
                        <input type="text" class="form-control" name="plant_name" placeholder="Plant Name">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Raw Materials Loading</label>
                        <input type="text" class="form-control" name="raw_materials_loading" placeholder="Raw Materials Loading">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Setup</label>
                        <input type="text" class="form-control" name="setup" placeholder="Setup">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Warmup</label>
                        <input type="text" class="form-control" name="warmup" placeholder="Warmup">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Fine Tuning Time</label>
                        <input type="text" class="form-control" name="fine_tuning_time" placeholder="Fine Tuning Time">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Production Start</label>
                        <input type="text" class="form-control" name="production_start" placeholder="Production Start">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Ancipated Process Time</label>
                        <input type="text" class="form-control" name="ancipated_process_time" placeholder="Ancipated Process Time">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Maintenance</label>
                        <input type="text" class="form-control" name="maintenance" placeholder="Maintenance">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Resuming</label>
                        <input type="text" class="form-control" name="resuming" placeholder="Resuming">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tolerant</label>
                        <input type="text" class="form-control" name="tolerant" placeholder="Tolerant">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Production Finish</label>
                        <input type="text" class="form-control" name="production_finish" placeholder="Production Finish">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Labours Hour</label>
                        <input type="text" class="form-control" name="labours_hour" placeholder="Labours Hour">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Down Time</label>
                        <input type="text" class="form-control" name="down_time" placeholder="Down Time">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-success me-2">ADD</button>
                    </div>
                </div>

                <hr>

                <table class="table table-bordered" id="tbl_planttimemanagement">
                    <thead>
                        <tr>
                            <td>Raw Materials Loading</td>
                            <td>Setup</td>
                            <td>Warmup</td>
                            <td>Fine Tuning Time</td>
                            <td>Production Start</td>
                            <td>Ancipated Process Time</td>
                            <td>Maintenance</td>
                            <td>Resuming</td>
                            <td>Tolerant</td>
                            <td>Production Finish</td>
                            <td>Labours Hour</td>
                            <td>Down Time</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>


                <button type="submit" class="btn btn-success me-2">Complete Plant Time Management</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
