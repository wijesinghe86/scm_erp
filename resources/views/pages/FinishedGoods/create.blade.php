@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Finished Goods Entry Note</h4>
            <form class="forms-sample" method="POST" action="{{ route('finishedgoods.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Finished Goods Number</label>
                        <input type="number" class="form-control" name="finished_good_number" placeholder="Finished Good Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Raw Material Issue Number</label>
                        <input type="text" class="form-control" name="row_material_ Issue _number" placeholder="Raw Material Issue Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Job Order Number</label>
                        <input type="text" class="form-control" name="warehouse_code" placeholder="Job Order Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>PPS Number</label>
                        <input type="text" class="form-control" name="pps_number" placeholder="PPS Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Batch Number</label>
                        <input type="text" class="form-control" name="batch_number" placeholder="Batch Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Plant Number</label>
                        <input type="text" class="form-control" name="plant_number" placeholder="Plant Number">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" placeholder="Serial Number">
                    </div>
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
                    <div class="form-group col-md-3">
                        <label>Issuing Quantity</label>
                        <input type="number" class="form-control" name="issuing_quantity" placeholder="Issuing Quantity">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Product Quantity</label>
                        <input type="number" class="form-control" name="product_quantity" placeholder="Product Quantity">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Production Weight</label>
                        <input type="text" class="form-control" name="production_weight" placeholder="Production Weight">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Wastage Quantity</label>
                        <input type="number" class="form-control" name="wastage_quantity" placeholder="Wastage Quantity">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-success me-2">ADD</button>
                    </div>
                </div>

                <hr>

                <table class="table table-bordered" id="tbl_finishedgoods">
                    <thead>
                        <tr>
                            <td>Stock Number</td>
                            <td>Serial Number</td>
                            <td>Warehouse Code</td>
                            <td>Issuing Quantity</td>
                            <td>Product Quantity</td>
                            <td>Production Weight</td>
                            <td>Wastage Quantity</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Created By</label>
                        <input type="text" class="form-control" name="created_by" placeholder="Created By">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Created Date</label>
                        <input type="date" class="form-control" name="created_date" placeholder="Created Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Approved Date</label>
                        <input type="date" class="form-control" name="approved_date" placeholder="Approved Date">
                    </div>
                </div>


                <button type="submit" class="btn btn-success me-2">Complete Finished Goods</button>

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
