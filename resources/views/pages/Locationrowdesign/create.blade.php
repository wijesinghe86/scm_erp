@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Location Row Design </h4>
                    <form class="forms-sample" method="POST" action="{{ route('locationrowdesign.store') }}">
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
                        <input type="text" class="form-control" name="row_number" placeholder="Row Number">
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Bay Description</label>
                        <input type="text" class="form-control" name="row_description" placeholder="Bay Description">
                      </div>
                      </div>

                    <div class="row">
                      <div class="form-group col-md-3">
                        <label>Row Height</label>
                        <input type="number" class="form-control" name="row_height" placeholder="Row Height">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Row Width</label>
                        <input type="number" class="form-control" name="row_width" placeholder="Row Width">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Row Length</label>
                        <input type="number" class="form-control" name="row_length" placeholder="Row Length">
                      </div>
                      <div class="form-group col-md-3">
                        <label>Row Floor Area</label>
                        <input type="number" class="form-control" name="row_floor_area" placeholder="Row Floor Area">
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
      .select2-container .select-locationrowdesign--single{
          height: 46px;
      }
      </style>

  @endpush
