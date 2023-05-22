@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Row Design Details View</h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationrowdesign.store') }}">
                    @csrf
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Warehouse Code :</label>
                            <span>{{$locationrowdesigns->warehouse_code}}</span>
                        </div>
                    </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                            <label>Bay Number :</label>
                            <span>{{$locationrowdesigns->bay_number}}</span>
                        </div>
                    </div>
                        <div class="row">
                      <div class="form-group col-md-4">
                            <label>Row Number :</label>
                            <span>{{$locationrowdesigns->row_number}}</span>
                        </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Bay Description :</label>
                        <span>{{$locationrowdesigns->row_description}}</span>
                        </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Row Height :</label>
                        <span>{{$locationrowdesigns->row_height}}</span>
                        </div>
                    </div>
                        <div class="row">
                      <div class="form-group col-md-3">
                        <label>Row Width :</label>
                        <span>{{$locationrowdesigns->row_width}}</span>
                          </div>
                        </div>
                          <div class="row">
                      <div class="form-group col-md-3">
                        <label>Row Length :</label>
                        <span>{{$locationrowdesigns->row_length}}</span>
                          </div>
                        </div>
                          <div class="row">
                      <div class="form-group col-md-3">
                        <label>Row Floor Area :</label>
                        <span>{{$locationrowdesigns->row_floor_area}}</span>
                        </div>
                    </div>

                    <a href="{{ route('locationrowdesign.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

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
