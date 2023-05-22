@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Fleet Registration</h4>
            <form class="forms-sample" method="POST" action="{{ route('fleetregistration.update',$fleetregistrations->id) }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Fleet Number</label>
                        <input type="text" class="form-control" name="fleet_number" placeholder="Fleet Number" value="{{$fleetregistrations->fleet_number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fleet Name</label>
                        <input type="text" class="form-control" name="fleet_name" placeholder="Fleet Name" value="{{$fleetregistrations->fleet_name}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fleet Registration Number</label>
                        <input type="text" class="form-control" name="fleet_registration_number" placeholder="Fleet Registration Number" value="{{$fleetregistrations->fleet_registration_number}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Current Owner</label>
                        <input type="text" class="form-control" name="current_owner" placeholder="Current Owner" value="{{$fleetregistrations->current_owner}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Category Of Fleet</label>
                        <SELECT name="category_of_fleet" class="form-control" value="{{$fleetregistrations->category_of_fleet}}">
                            <option selected disabled>Select Status</option>
                            <option {{ ($fleetregistrations->category_of_fleet =="1"?"selected":"") }} value="1">Fleet</option>
                            <option {{ ($fleetregistrations->category_of_fleet =="2"?"selected":"") }} value="2">Van</option>
                        </SELECT>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Current Meter Reading</label>
                        <input type="text" class="form-control" name="current_meter_reading" placeholder="Current Meter Reading" value="{{$fleetregistrations->current_meter_reading}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Type Of Fuel Consumption</label>
                        <SELECT name="type_of_fuel_consumption" class="form-control" value="{{$fleetregistrations->type_of_fuel_consumption}}">
                            <option selected disabled>Select Status</option>
                            <option {{ ($fleetregistrations->type_of_fuel_consumption =="1"?"selected":"") }}  value="1">Petrol</option>
                            <option {{ ($fleetregistrations->type_of_fuel_consumption =="2"?"selected":"") }}  value="2">Diesel</option>
                            <option {{ ($fleetregistrations->type_of_fuel_consumption =="3"?"selected":"") }}  value="3">Compressed Natural Gas</option>
                            <option {{ ($fleetregistrations->type_of_fuel_consumption =="4"?"selected":"") }}  value="4">Bio-Diesel</option>
                            <option {{ ($fleetregistrations->type_of_fuel_consumption =="5"?"selected":"") }}  value="5">Liquid Petroleum Gas</option>
                            <option {{ ($fleetregistrations->type_of_fuel_consumption =="6"?"selected":"") }}  value="6">Ethanol / Methanol</option>
                        </SELECT>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Loading Capacity</label>
                        <input type="text" class="form-control" name="loading_capacity" placeholder="Loading Capacity" value="{{$fleetregistrations->loading_capacity}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fleet Type</label>
                        <SELECT name="fleet_type" class="form-control" value="{{$fleetregistrations->fleet_type}}">
                            <option selected disabled>Select Status</option>
                            <option {{ ($fleetregistrations->fleet_type =="1"?"selected":"") }} value="1">Company Own</option>
                            <option {{ ($fleetregistrations->fleet_type =="2"?"selected":"") }} value="2">Hiring</option>
                        </SELECT>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Make</label>
                        <input type="text" class="form-control" name="make" placeholder="Make" value="{{$fleetregistrations->make}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Model</label>
                        <input type="text" class="form-control" name="model" placeholder="Model" value="{{$fleetregistrations->model}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fleet Manufacture Year</label>
                        <input type="text" class="form-control" name="fleet_manufacture_year" placeholder="Fleet Type" value="{{$fleetregistrations->fleet_manufacture_year}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Colour</label>
                        <input type="text" class="form-control" name="colour" placeholder="Colour" value="{{$fleetregistrations->colour}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Engine Capacity</label>
                        <input type="text" class="form-control" name="engine_capacity" placeholder="Engine Capacity" value="{{$fleetregistrations->engine_capacity}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Engine Number</label>
                        <input type="text" class="form-control" name="engine_number" placeholder="Engine Number" value="{{$fleetregistrations->engine_number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Chassis Number</label>
                        <input type="text" class="form-control" name="chassis_number" placeholder="Chassis Number" value="{{$fleetregistrations->chassis_number}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Tax Period From</label>
                        <input type="date" class="form-control" name="tax_period_from" placeholder="Tax Period From" value="{{$fleetregistrations->tax_period_from}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tax Period To</label>
                        <input type="date" class="form-control" name="tax_period_to" placeholder="Tax Period To" value="{{$fleetregistrations->tax_period_to}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Paid Amount</label>
                        <input type="float" class="form-control" name="paid_amount" placeholder="Paid Amount" value="{{$fleetregistrations->paid_amount}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Insured Company</label>
                        <input type="text" class="form-control" name="insured_company" placeholder="Insured Company" value="{{$fleetregistrations->insured_company}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Insurance Policy</label>
                        <input type="text" class="form-control" name="insurance_policy" placeholder="Insurance Policy" value="{{$fleetregistrations->insurance_policy}}">
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Period</label>
                        <input type="text" class="form-control" name="period" placeholder="Period" value="{{$fleetregistrations->period}}">
                    </div> --}}
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Insurance Start Date</label>
                        <input type="date" class="form-control" name="insurance_start_date" placeholder="Insurance Start Date" value="{{$fleetregistrations->insurance_start_date}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Insurance Expire Date</label>
                        <input type="date" class="form-control" name="insurance_expire_date" placeholder="Insurance Expire Date" value="{{$fleetregistrations->insurance_expire_date}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Amount</label>
                        <input type="float" class="form-control" name="amount" placeholder="Amount" value="{{$fleetregistrations->amount}}">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Update</button>
                <a href="{{ route('fleetregistration.index') }}" class="btn btn-primary me-2"> Previous </a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

