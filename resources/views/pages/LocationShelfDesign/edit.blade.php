@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Shelf Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationshelfdesign.update',$locationshelfdesigns->id) }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warehouse Code</label>
                            <input type="text" class="form-control" name="warehouse_code" value="{{$locationshelfdesigns->warehouse_code}}">
                        </div>
                     <div class="form-group col-md-4">
                        <label>Bay Number</label>
                        <input type="text" class="form-control" name="bay_number" value="{{$locationshelfdesigns->bay_number}}">
                        </div>
                      <div class="form-group col-md-4">
                        <label>Row Number</label>
                        <input type="text" class="form-control" name="row_number" value="{{$locationshelfdesigns->row_number}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Rack Number</label>
                            <input type="text" class="form-control" name="rack_number" value="{{$locationshelfdesigns->rack_number}}">
                            </div>

                          <div class="form-group col-md-4">
                            <label>Shelf Number</label>
                            <input type="text" class="form-control" name="shelf_number" placeholder="Shelf Number" value="{{$locationshelfdesigns->shelf_number}}">
                          </div>

                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Shelf Description</label>
                        <input type="text" class="form-control" name="shelf_description" placeholder="Shelf Description" value="{{$locationshelfdesigns->shelf_description}}">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Shelf Height</label>
                        <input type="text" class="form-control" name="shelf_height" placeholder="Shelf Height" value="{{$locationshelfdesigns->shelf_height}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Shelf Width</label>
                        <input type="text" class="form-control" name="shelf_width" placeholder="Shelf Width" value="{{$locationshelfdesigns->shelf_width}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Shelf Length</label>
                        <input type="text" class="form-control" name="shelf_length" placeholder="Shelf Length" value="{{$locationshelfdesigns->shelf_length}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Shelf Floor Area</label>
                        <input type="text" class="form-control" name="shelf_floor_area" placeholder="Shelf Floor Area" value="{{$locationshelfdesigns->shelf_floor_area}}">
                      </div>
                    </div>


                      <button type="submit" class="btn btn-success me-2">Update</button>
                      <a href="{{ route('locationshelfdesign.index') }}" class="btn btn-primary me-2"> Previous </a>

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
      .select2-container .select-locationshelfdesign--single{
          height: 46px;
      }
      </style>

  @endpush
