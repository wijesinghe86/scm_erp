@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Equipment Registration</h4>
            <form class="forms-sample" method="POST" action="{{ route('equipmentregistration.update',$equipmentregistrations->id) }}">
              @csrf
              <br>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Equipment Code</label>
                        <input type="text" class="form-control" name="equipment_code" placeholder="Equipment Code" value="{{$equipmentregistrations->equipment_code}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number" value="{{$equipmentregistrations->stock_number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Equipment Name</label>
                        <input type="text" class="form-control" name="equipment_name" placeholder="Equipment Name" value="{{$equipmentregistrations->equipment_name}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Equipment Description</label>
                        <input type="text" class="form-control" name="equipment_description" placeholder="Equipment Description" value="{{$equipmentregistrations->equipment_description}}">
                    </div>
                </div>

                <div class="row">
                <div class="form-group col-md-4">
                        <label>Equipment Type</label>
                        <SELECT name="equipment_type" class="form-control" value="{{$equipmentregistrations->equipment_type}}">
                            <option selected disabled>Select Status</option>
                            <option {{ ($equipmentregistrations->equipment_type =="1"?"selected":"") }} value="1">Physical</option>
                            <option {{ ($equipmentregistrations->equipment_type =="2"?"selected":"") }} value="2">Chemical</option>
                            <option {{ ($equipmentregistrations->equipment_type =="3"?"selected":"") }} value="3">Mechanical</option>
                        </SELECT>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Condition</label>
                        <input type="text" class="form-control" name="condition" placeholder="Condition" value="{{$equipmentregistrations->condition}}">
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label>Power Source </label>
                        <SELECT name="power_source " class="form-control" value="{{$equipmentregistrations->power_source}}">
                            <option selected disabled>Select Status</option>
                            <option {{ ($equipmentregistrations->power_source =="1"?"selected":"") }} value="1">Electric</option>
                            <option {{ ($equipmentregistrations->power_source =="2"?"selected":"") }} value="2">Solar</option>
                            <option {{ ($equipmentregistrations->power_source =="3"?"selected":"") }} value="3">Diesel</option>
                            <option {{ ($equipmentregistrations->power_source =="4"?"selected":"") }} value="4">Battery</option>
                        </SELECT>
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Update</button>
                <a href="{{ route('equipmentregistration.index') }}" class="btn btn-primary me-2"> Previous </a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

