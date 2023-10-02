@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Department Creation Master</h4>
            <form class="forms-sample" method="POST" action="{{ route('department.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Department Number</label>
                        <input type="text" class="form-control" name="department_number" placeholder="Department Number" value="{{$next_number}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Department Name *</label>
                        <input type="text" class="form-control" name="department_name" placeholder="Department Name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Department Description *</label>
                        <input type="text" class="form-control" name="department_description" placeholder="Department Description">
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="remark" placeholder="Remarks">
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
