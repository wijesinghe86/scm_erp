@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tax Creation Details View</h4>
            <form class="forms-sample" >
              @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tax Code :</label>
                        <span>{{$taxcreations->tax_code}}</span>
                    </div>
                </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>Tax Name :</label>
                        <span>{{$taxcreations->tax_name}}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Tax Description :</label>
                        <span>{{$taxcreations->tax_description}}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Start Date :</label>
                        <span>{{$taxcreations->start_date}}</span>
                    </div>
                </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>Expire Date :</label>
                        <span>{{$taxcreations->expire_date}}</span>
                    </div>
                </div>
                <a href="{{ route('taxcreation.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
