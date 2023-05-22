@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Storage Area Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('storagearea.store') }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Area Humidity </label>
                          <input type="text" class="form-control" name="area_humidity " placeholder="Area Humidity">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Bay Width </label>
                          <input type="text" class="form-control" name="bay_width " placeholder="Bay Width">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Bay Length </label>
                            <input type="text" class="form-control" name="bay_length  " placeholder="Bay Length">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <p>Adjustable Each Rows </p>
                            <input type="radio"  name="adjustable_each_rows " value="Yes">
                            <label>Yes</label>
                            <input type="radio"  name="adjustable_each_rows " value="No">
                            <label>No</label>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Number of Rows </label>
                          <input type="text" class="form-control" name="number_of_rows " placeholder="Number of Rows">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Number of Racks </label>
                            <input type="text" class="form-control" name="number_of_racks " placeholder="Number of Racks">
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Road Length Between Bays </label>
                          <input type="text" class="form-control" name="road_length_between_bays " placeholder="Road Length Between Bays">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Number of Access Forklift </label>
                            <input type="text" class="form-control" name="number_of_access_forklift " placeholder="Number of Access Forklift">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Bay Number </label>
                            <input type="text" class="form-control" name="bay_number " placeholder="Bay Number">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Row Number </label>
                            <input type="text" class="form-control" name="row_number " placeholder="Row Number">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Rack Number </label>
                            <input type="text" class="form-control" name="rack_number " placeholder="Rack Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Pallet Material  </label>
                            <input type="text" class="form-control" name="pallet_material  " placeholder="Pallet Material">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Product Type  </label>
                            <input type="text" class="form-control" name="product_type  " placeholder="Product Type">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Pitch  </label>
                            <input type="text" class="form-control" name="pitch  " placeholder="Pitch ">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Capacity  </label>
                            <input type="text" class="form-control" name="capacity" placeholder="Capacity">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Surface   </label>
                            <input type="text" class="form-control" name="surface" placeholder="Surface">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Colour  </label>
                            <input type="text" class="form-control" name="colour" placeholder="Colour ">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Rack Height </label>
                            <input type="text" class="form-control" name="rack_height" placeholder="Rack Height">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Complete Storage Area</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
