@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Stock Adjustment Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('stockadjustment.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Adjustment Number</label>
                        <input type="text" class="form-control" name="stock_adjustment_number" placeholder="Stock Adjustment Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Adjustment Date</label>
                        <input type="date" class="form-control" name="stock_adjustment_date " placeholder="Stock Adjustment Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Type</label>
                        <input type="text" class="form-control" name="type " placeholder="Type">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>From Stock Number</label>
                        <input type="text" class="form-control" name="from_stock_number" placeholder="From Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Transfer To Stock Number</label>
                        <input type="text" class="form-control" name="transfer_to_stock_number" placeholder="Transfer To Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" placeholder="Quantity">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Weight</label>
                        <input type="text" class="form-control" name="weight" placeholder="Weight">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Transfered Warehouse Code</label>
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Justification</label>
                        <input type="text" class="form-control" name="justification" placeholder="Justification">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">ADD</button>

                <hr>

                <table class="table table-bordered" id="tbl_goodsreceiveds">
                    <thead>
                        <tr>
                            <td>From Stock Number</td>
                            <td>Transfer To Stock Number</td>
                            <td>Quantity</td>
                            <td>Weight</td>
                            <td>Transfered Warehouse Code</td>
                            <td>Justification</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Created By</label>
                        <input type="text" class="form-control" name="created_by" placeholder="Created By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Created Date</label>
                        <input type="date" class="form-control" name="created_date" placeholder="Created Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Approved Date</label>
                        <input type="date" class="form-control" name="approved_date" placeholder="Approved Date">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Complete Stock Adjustment</button>
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
