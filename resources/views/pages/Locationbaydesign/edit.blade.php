@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Location Bay Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationbaydesign.update',$locationbays->id) }}">
                    @csrf
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code" value="{{$locationbays->warehouse_code}}">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Bay Number</label>
                        <input type="text" class="form-control" name="bay_number" placeholder="Bay Number" value="{{$locationbays->bay_number}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Bay Description</label>
                        <input type="text" class="form-control" name="bay_description" placeholder="Bay Description" value="{{$locationbays->bay_description}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Bay Height</label>
                        <input type="text" class="form-control" name="bay_height" placeholder="Bay Height" value="{{$locationbays->bay_height}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Bay Width</label>
                        <input type="text" class="form-control" name="bay_width" placeholder="Bay Width" value="{{$locationbays->bay_width}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Bay Length</label>
                        <input type="text" class="form-control" name="bay_length" placeholder="Bay Length" value="{{$locationbays->bay_length}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Bay Floor Area</label>
                        <input type="text" class="form-control" name="bay_floor_area" placeholder="Bay Floor Area" value="{{$locationbays->bay_floor_area}}">
                      </div>
                    </div>

                      <button type="submit" class="btn btn-success me-2">Update</button>
                      <a href="{{ route('locationbaydesign.index') }}" class="btn btn-primary me-2"> Previous </a>

                    </form>
                  </div>
                </div>
              </div>
  @endsection
