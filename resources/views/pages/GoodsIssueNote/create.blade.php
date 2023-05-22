@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Goods Issue Note</h4>
          <form class="forms-sample" method="POST" action="{{ route('goodsissuenote.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Customer Code</label>
                    </div>
                    <div class="form-group col-md-3">
                        {{-- <input type="text" class="form-control" name="customer_code" placeholder="Customer Code"> --}}
                        <select class="form-control item-select" name="customer_code">
                            @foreach ($customers as $customer )
                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-success me-2">Search</button>
                    </div>
                </div>

                <hr>

                <table class="table table-bordered" id="tbl_finishedgoods">
                    <thead>
                        <tr>
                            <td>Customer Name</td>
                            <td>Customer Address</td>
                            <td>Customer Mobile Number</td>
                            <td>Customer email</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
                <hr>
                <br>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issuing Goods Number</label>
                        <input type="number" class="form-control" name="issuing_goods_number" placeholder="Issuing Goods Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Invoice Number</label>
                        <input type="text" class="form-control" name="invoice_number" placeholder="Invoice Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Picking Location</label>
                        <input type="text" class="form-control" name="picking_location" placeholder="Picking Location">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Warehouse Code</label>
                        {{-- <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code"> --}}
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Request Quantity</label>
                        <input type="number" class="form-control" name="request_quantity" placeholder="Request Quantity">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Issued Quantity</label>
                        <input type="number" class="form-control" name="issued_quantity" placeholder="Issued Quantity">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">ADD</button>

                <hr>

                <table class="table table-bordered" id="tbl_finishedgoods">
                    <thead>
                        <tr>
                            <td>Stock Number</td>
                            <td>Issuing Goods Number</td>
                            <td>Invoice Number</td>
                            <td>Picking Location</td>
                            <td>Warehouse Code</td>
                            <td>Request Quantity</td>
                            <td>Issued Quantity</td>

                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Issued BY</label>
                        <input type="text" class="form-control" name="issued_by " placeholder="Issued By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issued Date</label>
                        <input type="date" class="form-control" name="issued_date " placeholder="Issued Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Submit</button>
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

