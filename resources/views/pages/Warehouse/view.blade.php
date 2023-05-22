@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Warehouse Details View</h4>
                    <form class="forms-sample" >
                    @csrf
                    <br>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Warehouse Code :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                        </div>
                    </div>

                        <div class="row">
                        <div class="form-group col-md-6">
                          <label>Warehouse Name :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Warehouse Description :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Warehouse Height :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                        </div>
                    </div>

                        <div class="row">
                        <div class="form-group col-md-3">
                          <label>Warehouse Width :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                          </div>
                        </div>

                          <div class="row">
                        <div class="form-group col-md-3">
                          <label>Warehouse Length :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                          </div>
                        </div>

                          <div class="row">
                        <div class="form-group col-md-12">
                          <label>Warehouse Floor Area :</label>
                          <span>{{$warehouses->warehouse_code}}</span>
                         </div>
                      </div>

                      <a href="{{ route('warehouse.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
