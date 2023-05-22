@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Edit Warehouse Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('warehouse.update',$warehouses->id) }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Warehouse Code</label>
                          <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code" value="{{$warehouses->warehouse_code}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Warehouse Name</label>
                          <input type="text" class="form-control" name="warehouse_name" placeholder="Warehouse Name" value="{{$warehouses->warehouse_name}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Warehouse Description</label>
                          <input type="text" class="form-control" name="description" placeholder="Warehouse Description" value="{{$warehouses->description}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Warehouse Height</label>
                          <input type="text" class="form-control" name="warehouse_height" placeholder="Warehouse Height" value="{{$warehouses->warehouse_height}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Warehouse Width</label>
                          <input type="text" class="form-control" name="warehouse_width" placeholder="Warehouse Width" value="{{$warehouses->warehouse_width}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Warehouse Length</label>
                          <input type="text" class="form-control" name="warehouse_length" placeholder="Warehouse Length" value="{{$warehouses->warehouse_length}}">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Warehouse Floor Area</label>
                          <input type="text" class="form-control" name="warehouse_floor_area" placeholder="Warehouse Floor Area" value="{{$warehouses->warehouse_floor_area}}">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-success me-2">Update</button>
                      <a href="{{ route('warehouse.index') }}" class="btn btn-primary me-2"> Previous </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
