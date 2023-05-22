@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Operation Mechanism Production And Time Management Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('operationmachanismproductionandtimemanagement.store') }}">
                    @csrf
                    <br><br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" placeholder="Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Production Planning Schedule Number</label>
                            <input type="text" class="form-control" name="production_planning_schedule_number" placeholder="Production Planning Schedule Number">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Job Order Number</label>
                            <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                        </div>
                    </div>

                    <hr>
                    <br>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Time Fraction</label>
                          <input type="time" class="form-control" name="time_fraction" placeholder="Time Fraction">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Stock Level</label>
                          <input type="text" class="form-control" name="stock_level" placeholder="Stock Level">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Backlog Level</label>
                            <input type="text" class="form-control" name="backlog_level" placeholder="Backlog Level">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Cost</label>
                            <input type="text" class="form-control" name="cost" placeholder="Cost">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Stock Cost</label>
                            <input type="text" class="form-control" name="stock_cost " placeholder="Stock Cost">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Storage Capacity</label>
                            <input type="text" class="form-control" name="storage_capacity " placeholder="Storage Capacity">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Demand</label>
                          <input type="text" class="form-control" name="demand " placeholder="Demand">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Production</label>
                            <input type="text" class="form-control" name="production" placeholder="Production">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Setup Time</label>
                            <input type="time" class="form-control" name="setup_time" placeholder="Setup Time">
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warmup Time</label>
                            <input type="time" class="form-control" name="warmup_time  " placeholder="Warmup Time">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Production Time</label>
                            <input type="time" class="form-control" name="production_time" placeholder="Production Time">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Planning Engine</label>
                            <input type="text" class="form-control" name="planning_engine" placeholder="Planning Engine">
                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Capacity Model</label>
                                <input type="text" class="form-control" name="capacity_model" placeholder="Capacity Model">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Planning Factors</label>
                                <input type="text" class="form-control" name="planning_factors" placeholder="Planning Factors">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Business Rules</label>
                                <input type="text" class="form-control" name="business_rules" placeholder="Business Rules">
                            </div>
                            </div>


                      <button type="submit" class="btn btn-success me-2">Complete Operation Mechanism Production</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
