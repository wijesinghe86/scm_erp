@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Row Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationrowdesign.update',$locationrowdesigns->id) }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warehouse Code</label>
                            {{-- <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code"> --}}
                            {{-- <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code"> --}}
                            <input type="text" class="form-control" name="warehouse_code" value="{{$locationrowdesigns->warehouse_code}}">
                             </div>
                     <div class="form-group col-md-4">
                        <label>Bay Number</label>
                        <input type="text" class="form-control" name="bay_number"  value="{{$locationrowdesigns->bay_number}}">
                       </div>
                      <div class="form-group col-md-4">
                        <label>Row Number</label>
                        <input type="text" class="form-control" name="row_number" placeholder="Row Number" value="{{$locationrowdesigns->row_number}}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Bay Description</label>
                        <input type="text" class="form-control" name="row_description" placeholder="Bay Description" value="{{$locationrowdesigns->row_description}}">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Row Height</label>
                        <input type="text" class="form-control" name="row_height" placeholder="Row Height" value="{{$locationrowdesigns->row_height}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Row Width</label>
                        <input type="text" class="form-control" name="row_width" placeholder="Row Width" value="{{$locationrowdesigns->row_width}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Row Length</label>
                        <input type="text" class="form-control" name="row_length" placeholder="Row Length" value="{{$locationrowdesigns->row_length}}">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Row Floor Area</label>
                        <input type="text" class="form-control" name="row_floor_area" placeholder="Row Floor Area" value="{{$locationrowdesigns->row_floor_area}}">
                      </div>
                    </div>

                      <button type="submit" class="btn btn-success me-2">Update</button>
                      <a href="{{ route('locationrowdesign.index') }}" class="btn btn-primary me-2"> Previous </a>

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
