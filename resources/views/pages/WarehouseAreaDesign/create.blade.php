@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Warehouse Area Design Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('warehouseareadesign.store') }}">
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
                      </div>

                      <div class="row">
                        <div class="form-group col-md-12">
                          <label>Warehouse Description</label>
                          <input type="text" class="form-control" name="description" placeholder="Warehouse Description">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Warehouse Area</label>
                          <input type="text" class="form-control" name="warehouse_area" placeholder="Warehouse Area">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Warehouse Storage Capacity</label>
                            <input type="text" class="form-control" name="warehouse_storage_capacity" placeholder="Warehouse Storage Capacity">
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Bay Area</label>
                          <input type="text" class="form-control" name="bay_area" placeholder="Bay Area">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Bay Number</label>
                            <input type="text" class="form-control" name="bay_number" placeholder="Bay Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Bay Area Description</label>
                            <input type="text" class="form-control" name="bay_area_description" placeholder="Bay Area Description">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Complete Warehouse Area Design</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
