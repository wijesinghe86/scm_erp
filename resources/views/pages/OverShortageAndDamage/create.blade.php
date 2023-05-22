@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Over, Short and Damage Details Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('overshortanddamage.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Over / Short and Damage Report Number</label>
                        <input type="text" class="form-control" name="over_short_damage_report_number " placeholder="Over / Short and Damage Report Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Goods Receiving Number</label>
                        <input type="text" class="form-control" name="grn_number  " placeholder="Goods Receiving Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Purchase Order Number</label>
                        <input type="text" class="form-control" name="po_number " placeholder="Purchase Order Numberr">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Supplier Code</label>
                        <select class="form-control item-select" name="supplier_code">
                        @foreach ($suppliers as $supplier )
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number " placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" placeholder="Serial Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Batch Number</label>
                        <input type="text" class="form-control" name="batch_number " placeholder="Batch Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Expire Date</label>
                        <input type="date" class="form-control" name="expire_date  " placeholder="Expire Date">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Complete Over, Short and Damage</button>
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
