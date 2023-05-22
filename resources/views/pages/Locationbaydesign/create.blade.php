@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Bay Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationbaydesign.store') }}">
                    @csrf
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        {{-- <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code"> --}}
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                    </div>
                      <div class="form-group col-md-4">
                        <label>Bay Number</label>
                        <input type="text" class="form-control" name="bay_number" placeholder="Bay Number">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Bay Description</label>
                        <input type="text" class="form-control" name="bay_description" placeholder="Bay Description">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Bay Height</label>
                        <input type="number" class="form-control" name="bay_height" placeholder="Bay Height">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Bay Width</label>
                        <input type="number" class="form-control" name="bay_width" placeholder="Bay Width">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Bay Length</label>
                        <input type="number" class="form-control" name="bay_length" placeholder="Bay Length">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Bay Floor Area</label>
                        <input type="number" class="form-control" name="bay_floor_area" placeholder="Bay Floor Area">
                      </div>
                    </div>

                      <button type="submit" class="btn btn-success me-2">Submit</button>

                    </form>
                  </div>
                </div>
              </div>
  @endsection
