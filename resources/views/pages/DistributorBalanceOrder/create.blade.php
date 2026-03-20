@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Balance Order</h4>
            <form class="forms-sample" method="POST" action="{{ route('balanceorder.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Customer Code</label>
                        <input type="text" class="form-control" name="customer_code" placeholder="Customer Code">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issue Document Number</label>
                        <input type="text" class="form-control" name="issue_number " placeholder="Issue Document Numbe">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code">
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Invoice Number</label>
                        <input type="text" class="form-control" name="invoice_number" placeholder="Invoice Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Balance Order Quantity</label>
                        <input type="number" class="form-control" name="balance_quantity  " placeholder="Balance Order Quantity">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number " placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Reason For Balance</label>
                        <input type="text" class="form-control" name="reason_for_balance  " placeholder="Reason For Balance">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">ADD</button>

                <hr>

                <table class="table table-bordered" id="tbl_finishedgoods">
                    <thead>
                        <tr>
                            <td>Invoice Number</td>
                            <td>Date</td>
                            <td>Balance Quantity</td>
                            <td>Stock Number</td>
                            <td>Reason For Balance</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Created By</label>
                        <input type="text" class="form-control" name="createdby  " placeholder="Created By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Created Date</label>
                        <input type="text" class="form-control" name="created_date" placeholder="Created Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Approved Date</label>
                        <input type="text" class="form-control" name="approved_date" placeholder="Approved Date">
                    </div>
                </div>


                <button type="submit" class="btn btn-success me-2">Complete Balance Order</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
