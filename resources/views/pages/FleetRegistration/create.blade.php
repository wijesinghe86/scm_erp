@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Fleet Registration Creation Master </h4>
            <form class="forms-sample" method="POST" action="{{ route('fleetregistration.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Fleet Number *</label>
                        <input type="text" class="form-control" name="fleet_number" placeholder="Fleet Number" value="{{$next_number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fleet Name *</label>
                        <input type="text" class="form-control" name="fleet_name" placeholder="Fleet Name">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fleet Registration Number *</label>
                        <input type="text" class="form-control" name="fleet_registration_number" placeholder="Fleet Registration Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Fleet Manufacturer</label>
                        <input type="text" class="form-control" name="fleet_model_manufacture" placeholder="Fleet Model Manufacture">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Category of Fleet</label>
                        <SELECT name="category_of_fleet" class="form-control">
                            <option value=""> Select </option>
                            <option value="1">Fleet</option>
                            <option value="2">Van</option>
                        </SELECT>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Current Meter Reading</label>
                        <input type="text" class="form-control" name="current_meter_reading" placeholder="Current Meter Reading">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Type of Fuel Consumption</label>
                        <SELECT name="type_of_fuel_consumption" class="form-control">
                            <option value=""> Select </option>
                            <option value="1">Petrol</option>
                            <option value="2">Diesel</option>
                            <option value="3">Compressed Natural Gas</option>
                            <option value="4">Bio-Diesel</option>
                            <option value="5">Liquid Petroleum Gas</option>
                            <option value="6">Ethanol / Methanol</option>
                        </SELECT>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Loading Capacity</label>
                        <input type="text" class="form-control" name="loading_capacity" placeholder="Loading Capacity">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fleet Type</label>
                        <SELECT name="fleet_type" class="form-control">
                            <option value=""> Select </option>
                            <option value="1">Company Own</option>
                            <option value="2">Hiring</option>
                        </SELECT>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Make</label>
                        <input type="text" class="form-control" name="make" placeholder="Make">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Model</label>
                        <input type="text" class="form-control" name="model" placeholder="Model">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fleet Manufacture Year</label>
                        <input type="number" class="form-control" name="fleet_manufacture_year" placeholder="Fleet Type">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Colour</label>
                        <input type="text" class="form-control" name="colour" placeholder="Colour">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Engine Capacity</label>
                        <input type="text" class="form-control" name="engine_capacity" placeholder="Engine Capacity">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Engine Number</label>
                        <input type="text" class="form-control" name="engine_number" placeholder="Engine Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Chassis Number</label>
                        <input type="text" class="form-control" name="chassis_number" placeholder="Chassis Number">
                    </div>
                </div>

                <p>Revenue</p>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Revenue  Period From</label>
                        <input type="date" class="form-control" name="tax_period_from" placeholder="Revenue Period From">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Revenue  Period To</label>
                        <input type="date" class="form-control" name="tax_period_to" placeholder="Revenue Period To">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Revenue Fee</label>
                        <input type="float" class="form-control" name="paid_amount" placeholder="Revenue Fee">
                    </div>
                </div>

                <p>Insurance</p>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Insured Company</label>
                        <input type="text" class="form-control" name="insured_company" placeholder="Insured Company">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Insurance Policy</label>
                        <input type="text" class="form-control" name="insurance_policy" placeholder="Insurance Policy">
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Period</label>
                        <input type="text" class="form-control" name="period" placeholder="Period">
                    </div>                     --}}
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Insurance Start Date</label>
                        <input type="date" class="form-control" name="insurance_start_date" placeholder="Insurance Start Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Insurance Expire Date</label>
                        <input type="date" class="form-control" name="insurance_expire_date" placeholder="Insurance Expire Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Insurance Amount</label>
                        <input type="float" class="form-control" name="amount" placeholder="Insurance Amount">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

