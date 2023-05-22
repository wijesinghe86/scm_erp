@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Rack Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationrackdesign.update',$locationrackdesigns->id) }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warehouse Code</label>
                            <input type="text" class="form-control" name="warehouse_code" value="{{$locationrackdesigns->warehouse_code}}">
                            </div>
                     <div class="form-group col-md-4">
                        <label>Bay Number</label>
                        <input type="text" class="form-control" name="bay_number" value="{{$locationrackdesigns->bay_number}}">
                        </div>
                      <div class="form-group col-md-4">
                        <label>Row Number</label>
                        <input type="text" class="form-control" name="row_number" value="{{$locationrackdesigns->row_number}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Rack Number</label>
                            <input type="text" class="form-control" name="rack_number" placeholder="Rack Number" value="{{$locationrackdesigns->rack_number}}">
                          </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Rack Description</label>
                        <input type="text" class="form-control" name="rack_description" placeholder="Rack Description" value="{{$locationrackdesigns->rack_description}}">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Rack Height</label>
                        <input type="text" class="form-control" name="rack_height" placeholder="Rack Height" value="{{$locationrackdesigns->rack_height}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Rack Width</label>
                        <input type="text" class="form-control" name="rack_width" placeholder="Rack Width" value="{{$locationrackdesigns->rack_width}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Rack Length</label>
                        <input type="text" class="form-control" name="rack_length" placeholder="Rack Length" value="{{$locationrackdesigns->rack_length}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Rack Floor Area</label>
                        <input type="text" class="form-control" name="rack_floor_area" placeholder="Rack Floor Area" value="{{$locationrackdesigns->rack_floor_area}}">
                      </div>
                    </div>

                      <button type="submit" class="btn btn-success me-2">Update</button>
                      <a href="{{ route('locationrackdesign.index') }}" class="btn btn-primary me-2"> Previous </a>

                    </form>
                  </div>
                </div>
              </div>
  @endsection

  @push('scripts')
  <script>
      $(document).ready(function(){
          $('.item-select').select2(
              {
                  placeholder: "Select Item",
              });
      });

  </script>
  @endpush

  @push('styles')
  <style>
      .select2-container .select-locationrowdesign--single{
          height: 46px;
      }
      </style>

  @endpush
