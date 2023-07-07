@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Warehouse Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('warehouse.store') }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Warehouse Code *</label>
                          <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code" value="{{$next_number}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Warehouse Name *</label>
                          <input type="text" class="form-control" name="warehouse_name" placeholder="Warehouse Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Warehouse Description</label>
                          <input type="text" class="form-control" name="description" placeholder="Warehouse Description">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-3">
                          <label>Warehouse Height</label>
                          <input type="number" class="form-control" name="warehouse_height" placeholder="Warehouse Height">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Warehouse Width</label>
                          <input type="number" class="form-control" name="warehouse_width" placeholder="Warehouse Width">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Warehouse Length</label>
                          <input type="number" class="form-control" name="warehouse_length" placeholder="Warehouse Length">
                        </div>
                        <div class="form-group col-md-3">
                          <label>Warehouse Floor Area</label>
                          <input type="number" class="form-control" name="warehouse_floor_area" placeholder="Warehouse Floor Area">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
