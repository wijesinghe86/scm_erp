@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Production Cost Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('productioncost.store') }}">
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

                    <hr>
                    <br>

                      <div class="row">
                        <div class="form-group col-md-3">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Unit</label>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Unit Cost</label>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total</label>
                         </div>
                        </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Raw Materials</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="raw_materials_unit" placeholder="Raw Materials Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="raw_materials_unit_cost" placeholder="Raw Materials Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="raw_materials_total_cost" placeholder="Raw Materials Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Management Staff</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="number_of_management_staff" placeholder="Number of Management Staff">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="management_staff_unit_cost" placeholder="Management Staff Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="management_staff_total_cost" placeholder="Management Staff Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Machine Hours Cost</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="machine_hour_working_unit" placeholder="Machine working Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="machine_hour_cost_per_unit" placeholder="Machine Hour Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="machine_hour_total_cost" placeholder="Machine Hour Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Electricity</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="electricity_unit" placeholder="Electricity Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="electricity_cost_per_unit" placeholder="Electricity Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="electricity_total_cost" placeholder="Electricity Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Spare Parts</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="spare_parts_unit" placeholder="Spare Parts Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="spare_parts_cost_per_unit" placeholder="Spare Parts Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="spare_parts_total_cost" placeholder="Spare Parts Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Accessories</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="accessories_unit" placeholder="Accessories Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="accessories_cost_per_unit" placeholder="Accessories Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="accessories_total_cost" placeholder="Accessories Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Semifinish Process</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="semifinish_unit" placeholder="Semifinish Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="semifinish_cost_per_unit" placeholder="Semifinish Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="semifinish_total_cost" placeholder="Semifinish Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label >Labours</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="labours_unit" placeholder="Labours Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="labours_cost_per_unit" placeholder="Labours Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="labours_total_cost" placeholder="Labours Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Backlog Cost</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="backlog_unit" placeholder="Backlog Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="backlog_cost_per_unit" placeholder="Backlog Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="backlog_total_cost" placeholder="Backlog Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Holding Cost</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="holding_unit" placeholder="Backlog Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="holding_cost_per_unit" placeholder="Backlog Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="holding_total_cost" placeholder="Backlog Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Maintenance Cost</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="maintenance_unit" placeholder="Maintenance Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="maintenance_cost_per_unit" placeholder="Maintenance Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="maintenance_total_cost" placeholder="Maintenance Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Materials Setup</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="materials_setup_unit" placeholder="Materials Setup Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="materials_setup_cost_per_unit" placeholder="Materials Setup Unit Cost">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="materials_setup_total_cost" placeholder="Materials Setup Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Production Engineering</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="production_engineering_unit" placeholder="Production Engineering Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="production_engineering_cost_per_unit" placeholder="Production Engineering">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="production_engineering_total_cost" placeholder="Production Engineering">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Planning Cost</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="planning_unit" placeholder="Planning Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="planning_cost_per_unit" placeholder="Planning Cost Per Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="planning_total_cost" placeholder="Planning Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Logistics</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="logistics_unit" placeholder="Logistics Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="logistics_cost_per_unit" placeholder="Logistics Cost Per Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="logistics_total_cost" placeholder="Logistics Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Adminstrative</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="adminstrative_unit" placeholder="Adminstrative Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="adminstrative_cost_per_unit" placeholder="Adminstrative Cost Per Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="adminstrative_total_cost" placeholder="Adminstrative Total Cost">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Training</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="number" class="form-control" name="training_unit" placeholder="Training Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="training_cost_per_unit" placeholder="Training Cost Per Unit">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="training_total_cost" placeholder="Training Total Cost">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Complete Production Cost</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
