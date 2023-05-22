@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Production Wastage Details Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('productionwastage.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Finished Good Number</label>
                        <input type="text" class="form-control" name="finished_good_number" placeholder="Finished Good Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Row Material Issue Number</label>
                        <input type="text" class="form-control" name="row_material_issue_number" placeholder="Row Material Issue Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Weight</label>
                        <input type="text" class="form-control" name="weight" placeholder="Weight">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Batch Number</label>
                        <input type="text" class="form-control" name="batch_number" placeholder="Batch Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Semi Row Material Serial Range</label>
                        <input type="text" class="form-control" name="semi_row_materialSerial_range" placeholder="Semi Row Material Serial Range">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Date">
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Job Order</label>
                        <input type="text" class="form-control" name="job_order" placeholder="Job Order">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Created By</label>
                        <input type="text" class="form-control" name="created_by" placeholder="Created By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Create Date</label>
                        <input type="date" class="form-control" name="create_date" placeholder="Create Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Approved Date</label>
                        <input type="date" class="form-control" name="approved_date" placeholder="Approved Date">
                    </div>

                </div>


                <button type="submit" class="btn btn-success me-2">Complete Production Wastage</button>

            </form>
        </div>
      </div>
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
      .select2-container .select-selection--single{
          height: 46px;
      }
      </style>

  @endpush
