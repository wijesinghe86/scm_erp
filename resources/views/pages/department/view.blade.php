@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Department Creation</h4>
            <form class="forms-sample" method="POST" action="{{ route('department.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Department Number :</label>
                        <span>{{$departments->department_number}}</span>
                    </div>
                </div>

                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>Department Name:</label>
                        <span>{{$departments->department_name}}</span>
                        </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Department Description :</label>
                        <span>{{$departments->department_description}}</span>
                        </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remark :</label>
                        <span>{{$departments->remark}}</span>
                        </div>
                </div>
                <a href="{{ route('department.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
