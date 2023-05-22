@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Fleet Registration Details View</h4>
            <form class="forms-sample" >
              @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Fleet Number :</label>
                        <span>{{$fleetregistrations->fleet_number}}</span>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Fleet Name :</label>
                        <span>{{$fleetregistrations->fleet_name}}</span>
                           </div>
                        </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Fleet Registration Number :</label>
                        <span>{{$fleetregistrations->fleet_registration_number}}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Current Owner :</label>
                        <span>{{$fleetregistrations->current_owner}}</span>
                         </div>
                        </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Category Of Fleet :</label>
                        <span>{{$fleetregistrations->category_of_fleet}}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Current Meter Reading :</label>
                        <span>{{$fleetregistrations->current_meter_reading}}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Type Of Fuel Consumption :</label>
                        <span>{{$fleetregistrations->type_of_fuel_consumption}}</span>
                   </div>
                    <div class="form-group col-md-6">
                        <label>Loading Capacity :</label>
                        <span>{{$fleetregistrations->loading_capacity}}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Fleet Type :</label>
                        <span>{{$fleetregistrations->fleet_type}}</span>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Make :</label>
                        <span>{{$fleetregistrations->make}}</span>
                        </div>
                    </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Model :</label>
                        <span>{{$fleetregistrations->model}}</span>
                       </div>
                    <div class="form-group col-md-6">
                        <label>Fleet Manufacture Year :</label>
                        <span>{{$fleetregistrations->fleet_manufacture_year}}</span>
                         </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Colour :</label>
                        <span>{{$fleetregistrations->colour}}</span>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Engine Capacity :</label>
                        <span>{{$fleetregistrations->engine_capacity}}</span>
                          </div>
                        </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Engine Number :</label>
                        <span>{{$fleetregistrations->engine_number}}</span>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Chassis Number :</label>
                        <span>{{$fleetregistrations->chassis_number}}</span>
                        </div>
                    </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tax Period From :</label>
                        <span>{{$fleetregistrations->tax_period_from}}</span>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Tax Period To :</label>
                        <span>{{$fleetregistrations->tax_period_to}}</span>
                         </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Paid Amount :</label>
                        <span>{{$fleetregistrations->paid_amount}}</span>
                          </div>
                    <div class="form-group col-md-6">
                        <label>Insured Company :</label>
                        <span>{{$fleetregistrations->insured_company}}</span>
                         </div>
                        </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Insurance Policy :</label>
                        <span>{{$fleetregistrations->insurance_policy}}</span>
                       </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Period</label>
                        <span>{{$fleetregistrations->period}}</span>
                       </div>                     --}}

                    <div class="form-group col-md-6">
                        <label>Insurance Start Date :</label>
                        <span>{{$fleetregistrations->insurance_start_date}}</span>
                        </div>
                    </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Insurance Expire Date :</label>
                        <span>{{$fleetregistrations->insurance_expire_date}}</span>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Amount :</label>
                        <span>{{$fleetregistrations->amount}}</span>
                        </div>
                </div>

                <a href="{{ route('fleetregistration.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

