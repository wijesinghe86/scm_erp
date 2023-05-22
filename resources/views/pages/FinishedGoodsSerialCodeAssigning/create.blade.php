@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Finished Goods Serial Code Entry</h4>
            <form class="forms-sample" method="POST" action="{{ route('finishedgoodsserialcodeassigning.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Finished Goods Number</label>
                        <input type="number" class="form-control" name="finished_goods_number" placeholder="Finished Goods Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Job Order Number</label>
                        <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Batch Number</label>
                        <input type="text" class="form-control" name="batch_number" placeholder="Batch Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Finished Goods Serial Number</label>
                        <input type="text" class="form-control" name="finished_goods_serial_number" placeholder="Finished Goods Serial Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Created By</label>
                        <input type="text" class="form-control" name="created_by" placeholder="Created By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Created Date</label>
                        <input type="text" class="form-control" name="created_date" placeholder="Created Date">
                    </div>
                </div>

                <button type="submit" class="btn btn-success me-2">Complete Finished Goods Serial Code</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
