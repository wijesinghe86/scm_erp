@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Dispatch Details Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('dispatch.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Dispatch Number</label>
                        <input type="text" class="form-control" name="dispatch_number" placeholder="Dispatch Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Dispatched Date</label>
                        <input type="date" class="form-control" name="dispatched_date" placeholder="Dispatched Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Batch Number</label>
                        <input type="text" class="form-control" name="batch_number" placeholder="Batch Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>From Location</label>
                        <input type="text" class="form-control" name="from_location" placeholder="From Location">
                    </div>
                    <div class="form-group col-md-4">
                        <label>To Location</label>
                        <input type="text" class="form-control" name="to_location" placeholder="To Location">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Finished Goods Number</label>
                        <input type="number" class="form-control" name="finished_goods_number" placeholder="Finished Goods Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Finish Goods Serial Range</label>
                        <input type="text" class="form-control" name="finish_goods_serial_range" placeholder="Finish Goods Serial Range">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Each Quantity</label>
                        <input type="number" class="form-control" name="each_quantity" placeholder="Each Quantity">
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Each Weight</label>
                        <input type="text" class="form-control" name="each_weight" placeholder="Each Weight">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Quantity</label>
                        <input type="number" class="form-control" name="total_quantity" placeholder="Total Quantity">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Weight</label>
                        <input type="text" class="form-control" name="total_weight" placeholder="Total Weight">
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
                            <td>Finished Good Number</td>
                            <td>Finish Good Serial Range</td>
                            <td>Each Quantity</td>
                            <td>Each Weight</td>
                            <td>Total Quantity</td>
                            <td>Total Weight</td>
                         </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table>

                <hr>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="remarks" placeholder="Remarks">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Dispatched By</label>
                        <input type="text" class="form-control" name="dispatched_by" placeholder="Dispatched By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Dispatched Date</label>
                        <input type="date" class="form-control" name="dispatched_date" placeholder="Dispatched Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Inspected By</label>
                        <input type="text" class="form-control" name="inspected_by" placeholder="Inspected By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Inspected Date</label>
                        <input type="date" class="form-control" name="inspected_date" placeholder="Inspected Date">
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

                <button type="submit" class="btn btn-success me-2">Complete Dispatch Creation</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
