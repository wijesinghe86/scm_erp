@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Bay Design Details View </h4>
                    <form class="forms-sample">
                    @csrf
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Warehouse Code :</label>
                        <span>{{$locationbays->equipment_code}}</span>
                    </div>
                </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Bay Number :</label>
                        <span>{{$locationbays->bay_number}}</span>
                         </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Bay Description :</label>
                        <span>{{$locationbays->bay_description}}</span>
                        </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Bay Height :</label>
                        <span>{{$locationbays->bay_height}}</span>
                         </div>
                        </div>
                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Bay Width :</label>
                        <span>{{$locationbays->bay_width}}</span>
                       </div>
                    </div>
                       <div class="row">
                      <div class="form-group col-md-3">
                        <label>Bay Length :</label>
                        <span>{{$locationbays->bay_length}}</span>
                        </div>
                    </div>
                        <div class="row">
                      <div class="form-group col-md-3">
                        <label>Bay Floor Area :</label>
                        <span>{{$locationbays->bay_floor_area}}</span>
                        </div>
                    </div>

                    <a href="{{ route('locationbaydesign.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

                    </form>
                  </div>
                </div>
              </div>
  @endsection
