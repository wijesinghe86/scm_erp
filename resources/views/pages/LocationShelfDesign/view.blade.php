@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Shelf Design Details View</h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationrackdesign.store') }}">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warehouse Code :</label>
                            <span>{{$locationshelfdesigns->warehouse_code}}</span>
                            </div>
                        </div>
                            <div class="row">
                     <div class="form-group col-md-4">
                        <label>Bay Number :</label>
                        <span>{{$locationshelfdesigns->bay_number}}</span>
                        </div>
                    </div>
                        <div class="row">
                      <div class="form-group col-md-4">
                        <label>Row Number :</label>
                        <span>{{$locationshelfdesigns->row_number}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Rack Number :</label>
                            <span>{{$locationshelfdesigns->rack_number}}</span>
                            </div>
                        </div>
                            <div class="row">
                          <div class="form-group col-md-4">
                            <label>Shelf Number :</label>
                            <span>{{$locationshelfdesigns->shelf_number}}</span>
                         </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Shelf Description :</label>
                        <span>{{$locationshelfdesigns->shelf_description}}</span>
                        </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Shelf Height :</label>
                        <span>{{$locationshelfdesigns->shelf_height}}</span>
                         </div>
                        </div>

                         <div class="row">
                      <div class="form-group col-md-3">
                        <label>Shelf Width :</label>
                        <span>{{$locationshelfdesigns->shelf_width}}</span>
                        </div>
                    </div>

                        <div class="row">
                      <div class="form-group col-md-3">
                        <label>Shelf Length :</label>
                        <span>{{$locationshelfdesigns->shelf_length}}</span>
                         </div>
                        </div>

                         <div class="row">
                      <div class="form-group col-md-3">
                        <label>Shelf Floor Area :</label>
                        <span>{{$locationshelfdesigns->shelf_floor_area}}</span>
                         </div>
                    </div>

                    <a href="{{ route('locationshelfdesign.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

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
