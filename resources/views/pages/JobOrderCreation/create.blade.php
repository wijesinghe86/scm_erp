@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Job Order Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('jobordercreation.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Job Order Number</label>
                        <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Job Order Date</label>
                        <input type="text" class="form-control" name="job_order_Date" placeholder="Job Order Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>PPS Number</label>
                        <input type="text" class="form-control" name="pps_number" placeholder="PPS Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Plant Number</label>
                        <input type="text" class="form-control" name="plant_number" placeholder="Plant Number">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Job Order Quantity</label>
                        <input type="number" class="form-control" name="job_order_quantity" placeholder="Job Order Quantity">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Weight</label>
                        <input type="text" class="form-control" name="weight" placeholder="Weight">
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="end_date" placeholder="End Date">
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Supervisor</label>
                        <input type="text" class="form-control" name="supervisor" placeholder="Supper Voicer">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Created By</label>
                        <input type="text" class="form-control" name="created_by" placeholder="Created By">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Created Date</label>
                        <input type="date" class="form-control" name="created_date" placeholder="Created Date">
                    </div>

                </div>
                <button type="submit" class="btn btn-success me-2">Complete Job Order Creation</button>

            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
