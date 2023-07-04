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
                        <label>SA No</label>
                        <input type="text" class="form-control" name="sa_number" placeholder="SA_No">
                    </div>
                    <div class="form-group col-md-4">
                        <label>SA Date</label>
                        <input type="date" class="form-control" name="stock_adjustment_date " placeholder="Stock Adjustment Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Warehouse</label>
                        <select class="form-control" name="warehouse_name">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Excess</label>
                        <input type="checkbox" class="form-control" name="Excess" placeholder="Excess">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Short</label>
                        <input type="checkbox" class="form-control" name="short" placeholder="Short">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Transfer</label>
                        <input type="checkbox" class="form-control" name="transfer" placeholder="transfer">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Reason</label>
                        <input type="text" class="form-control" name="reason" placeholder="reason">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Stock No</label>
                        <input type="checkbox" class="form-control" name="Excess" placeholder="Excess">
                    </div>
                    <div class="form-group col-md-8">
                        <label>Description</label>
                        <input type="checkbox" class="form-control" name="short" placeholder="Short">
                    </div>
                    <div class="form-group col-md-2">
                        <label>U/M</label>
                        <input type="checkbox" class="form-control" name="transfer" placeholder="transfer">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>On hand Balance</label>
                        <input type="checkbox" class="form-control" name="Excess" placeholder="Excess">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Qty to be Adjusted</label>
                        <input type="checkbox" class="form-control" name="short" placeholder="Short">
                    </div>
                    <div class="form-group col-md-4">
                        <label>On Hand Balance After Adjustment</label>
                        <input type="checkbox" class="form-control" name="transfer" placeholder="transfer">
                    </div>
                </div>
                <button type="submit" class="btn btn-success me-2">ADD</button>
                <table class="table" id="tbl_goodsreceiveds">
                    <thead>
                        <tr>
                            <td>Stock Number</td>
                            <td>Description</td>
                            <td>U/M</td>
                            <td>Qty</td>
                         </tr>
                    </thead>
                </table>
                <br>
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
