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
              <br>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Dispatch No</label>
                        <input type="text" class="form-control" name="dispatch_no" placeholder="Dispatch No">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Dispatched Date</label>
                        <input type="date" class="form-control" name="dispatched_date" placeholder="Dispatched Date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Dispatch From</label>
                        <input type="text" class="form-control" name="batch_from" placeholder="Diapatch From">
                    </div>
                    <div class="form-group col-md-5">
                        <label>FGRN No</label>
                        <input type="text" class="form-control" name="fgrn_no" placeholder="FGRN No">
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Total No.of Dispatched Items</label>
                        <input type="text" class="form-control" name="total_items" placeholder="Total Items">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total No.of Dispatched Qty</label>
                        <input type="text" class="form-control" name="total_qty" placeholder="Total Qty">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total No.of Dispatched Weight</label>
                        <input type="text" class="form-control" name="total_weight" placeholder="Total Weight">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Fleet No</label>
                        <select class="form-control" name="fleet">
                            @foreach ($fleets as $fleet )
                            <option value="{{ $fleet->id }}">{{ $fleet->fleet_registration_number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Driver Name</label>
                        <input type="text" class="form-control" name="remarks" placeholder="Remarks">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Dispatched By</label>
                        <select class="form-control" name="dispatched_by">
                            @foreach ($employees as $employee  )
                                <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Dispatched Date_Time</label>
                        <input type="date" class="form-control" name="dispatched_date" placeholder="Dispatched Date">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="dispatched_remark" placeholder="Remark">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Inspected By</label>
                        <select class="form-control" name="inspected_by">
                            @foreach ($employees as $employee  )
                                <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Inspected Date_Time</label>
                        <input type="date" class="form-control" name="inspected_date" placeholder="Inspected Date">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="inspected_remark" placeholder="Remark">
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
