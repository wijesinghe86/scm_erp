@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Equipment Maintenance Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('equipmentmaintenance.store') }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Unit Load Carriers  </label>
                          <input type="text" class="form-control" name="unit_load_carriers" placeholder="Unit Load Carriers">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Pallet Jacks   </label>
                          <input type="text" class="form-control" name="pallet_jacks" placeholder="Pallet Jacks">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Lift Equipment </label>
                            <input type="text" class="form-control" name="lift_equipment" placeholder="Lift Equipment">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Pallet Racks  </label>
                            <input type="text" class="form-control" name="pallet_racks" placeholder="Pallet Racks">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Ladders</label>
                          <input type="text" class="form-control" name="ladders" placeholder="Ladders">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Lights </label>
                            <input type="text" class="form-control" name="lights " placeholder="Lights  ">
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Fan</label>
                          <input type="text" class="form-control" name="fan" placeholder="Fan">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Air Conditioner </label>
                            <input type="text" class="form-control" name="air_conditioner " placeholder="Air Conditioner">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Fire Alarm</label>
                            <input type="text" class="form-control" name="fire_alarm   " placeholder="Fire Alarm">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fire Hydrant</label>
                            <input type="text" class="form-control" name="fire_hydrant   " placeholder="Fire Hydrant">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Vacuum Cleaner</label>
                            <input type="text" class="form-control" name="vacuum_cleaner   " placeholder="Vacuum Cleaner">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Water Tap</label>
                            <input type="text" class="form-control" name="water_tap " placeholder="Water Tap">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Complete Equipment Maintenance</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
