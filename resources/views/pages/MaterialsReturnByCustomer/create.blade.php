@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Materials Return By Customer Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('materialsreturnbycustomer.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Customer Code</label>
                        <select class="form-control item-select" name="customer_code">
                            @foreach ($customers as $customer )
                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Invoice Number</label>
                        <input type="text" class="form-control" name="invoice_number  " placeholder="Invoice Number">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number " placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Issue Document Number</label>
                        <input type="text" class="form-control" name="issue_document_number " placeholder="Issue Document Number">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Returned Quantity</label>
                        <input type="number" class="form-control" name="returned_quantity " placeholder="Returned Quantity">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Reason For Return</label>
                        <input type="text" class="form-control" name="reason_for_return" placeholder="Reason For Return">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">ADD</button>

                <hr>

                <table class="table table-bordered" id="tbl_goodsreceiveds">
                    <thead>
                        <tr>
                            <td>Invoice Number</td>
                            <td>Stock Number</td>
                            <td>Issue Document Number</td>
                            <td>Returned Quantity</td>
                            <td>Reason For Return</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Justification</label>
                        <input type="text" class="form-control" name="justification " placeholder="Justification">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Received By</label>
                        <input type="text" class="form-control" name="received_by" placeholder="Received By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Received Date</label>
                        <input type="date" class="form-control" name="received_date  " placeholder="Received Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Inspection Note</label>
                        <input type="text" class="form-control" name="inspection_note " placeholder="Inspection Note">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Inspected By</label>
                        <input type="text" class="form-control" name="inspectedby" placeholder="Inspected By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Inspected Date</label>
                        <input type="date" class="form-control" name="inspected_date  " placeholder="Inspected Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approvedby " placeholder="Approved By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Approved Date</label>
                        <input type="date" class="form-control" name="approved_date" placeholder="Approved Date">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Complete Materials Return By Customer</button>
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
