@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Department Details</h4>
            <form class="forms-sample" method="POST" action="{{ route('department.update',$departments->id) }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Department Number</label>
                        <input type="text" class="form-control" name="department_number" placeholder="Department Number" value="{{$departments->department_number}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Department Name</label>
                        <input type="text" class="form-control" name="department_name" placeholder="Department Name" value="{{$departments->department_name}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Department Description</label>
                        <input type="text" class="form-control" name="department_description" placeholder="Department Description" value="{{$departments->department_description}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remark</label>
                        <input type="text" class="form-control" name="remark" placeholder="Remark" value="{{$departments->remark}}">
                    </div>

                </div>
                <button type="submit" class="btn btn-success me-2">Update</button>
                <a href="{{ route('department.index') }}" class="btn btn-primary me-2"> Previous </a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
