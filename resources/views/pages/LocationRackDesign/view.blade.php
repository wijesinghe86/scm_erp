@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Rack Design Details View</h4>
                    <form class="forms-sample" >
                    @csrf
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warehouse Code :</label>
                            <span>{{$locationrackdesigns->warehouse_code}}</span>
                        </div>
                    </div>
                        <div class="row">
                     <div class="form-group col-md-4">
                        <label>Bay Number :</label>
                        <span>{{$locationrackdesigns->bay_number}}</span>
                        </div>
                    </div>
                        <div class="row">
                      <div class="form-group col-md-4">
                        <label>Row Number :</label>
                        <span>{{$locationrackdesigns->row_number}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Rack Number :</label>
                            <span>{{$locationrackdesigns->rack_number}}</span>
                             </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Rack Description :</label>
                        <span>{{$locationrackdesigns->rack_description}}</span>
                        </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Rack Height :</label>
                        <span>{{$locationrackdesigns->rack_height}}</span>
                        </div>
                    </div>
                        <div class="row">
                      <div class="form-group col-md-3">
                        <label>Rack Width :</label>
                        <span>{{$locationrackdesigns->rack_width}}</span>
                         </div>
                        </div>
                         <div class="row">
                      <div class="form-group col-md-3">
                        <label>Rack Length :</label>
                        <span>{{$locationrackdesigns->rack_length}}</span>
                       </div>
                    </div>
                       <div class="row">
                      <div class="form-group col-md-3">
                        <label>Rack Floor Area :</label>
                        <span>{{$locationrackdesigns->rack_floor_area}}</span>
                        </div>
                    </div>

                    <a href="{{ route('locationrackdesign.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

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
