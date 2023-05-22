@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Disposal</h4>
            <form class="forms-sample" method="POST" action="{{ route('department.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Disposal Document Number</label>
                        <input type="text" class="form-control" name="disposal_document_number" placeholder="Disposal Document Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Managed By</label>
                        <input type="text" class="form-control" name="managed_by " placeholder="Managed By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Inspected By</label>
                        <input type="text" class="form-control" name="inspected_by " placeholder="Inspected By">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Dispose Date</label>
                        <input type="date" class="form-control" name="dispose_date  " placeholder="Dispose Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Damage Quantity</label>
                        <input type="number" class="form-control" name="damage_quantity  " placeholder="Damage Quantity">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Product Value</label>
                        <input type="text" class="form-control" name="product_value" placeholder="Product Value">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Reason for Dispose</label>
                        <input type="text" class="form-control" name="reason_for_dispose  " placeholder="Reason for Dispose">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Mode of Dispose</label>
                        <input type="text" class="form-control" name="mode_of_dispose  " placeholder="Mode of Dispose">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Disposal Document</label>
                        <input type="text" class="form-control" name="disposal_document" placeholder="Disposal Document">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Disposal Place</label>
                        <input type="text" class="form-control" name="disposal_place   " placeholder="Disposal Place">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Complete Disposal</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
