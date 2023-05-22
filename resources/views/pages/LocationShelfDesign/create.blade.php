@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Shelf Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationshelfdesign.store') }}">
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
                        <select class="form-control item-select" name="bay_number">
                            @foreach ($locationbays as $locationbaydesign )
                            <option value="{{ $locationbaydesign->id }}">{{ $locationbaydesign->bay_number }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Row Number</label>
                        <select class="form-control item-select" name="row_number">
                            @foreach ($locationrowdesigns as $locationrowdesign )
                            <option value="{{ $locationrowdesign->id }}">{{ $locationrowdesign->row_number }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Rack Number</label>
                            <select class="form-control item-select" name="rack_number">
                                @foreach ($locationrackdesigns as $locationrackdesign )
                                <option value="{{ $locationrackdesign->id }}">{{ $locationrackdesign->rack_number }}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group col-md-4">
                            <label>Shelf Number</label>
                            <input type="text" class="form-control" name="shelf_number" placeholder="Shelf Number">
                          </div>

                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Shelf Description</label>
                        <input type="text" class="form-control" name="shelf_description" placeholder="Shelf Description">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Shelf Height</label>
                        <input type="number" class="form-control" name="shelf_height" placeholder="Shelf Height">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Shelf Width</label>
                        <input type="number" class="form-control" name="shelf_width" placeholder="Shelf Width">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Shelf Length</label>
                        <input type="number" class="form-control" name="shelf_length" placeholder="Shelf Length">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Shelf Square Area</label>
                        <input type="number" class="form-control" name="shelf_floor_area" placeholder="Shelf Square Area">
                      </div>
                    </div>

                      <button type="submit" class="btn btn-success me-2">Submit</button>

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
