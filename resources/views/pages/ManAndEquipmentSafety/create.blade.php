@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Man And Equipment Safety Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('manandequipmentsafety.store') }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Clothing </label>
                          <input type="text" class="form-control" name="clothing " placeholder="Clothing">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Hand Gloves</label>
                          <input type="text" class="form-control" name="hand_gloves" placeholder="Hand Gloves">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Helmet </label>
                            <input type="text" class="form-control" name="helmet" placeholder="Helmet ">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Eye-wear  </label>
                            <input type="text" class="form-control" name="eye_wear" placeholder="Eye-wear ">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Body Cover </label>
                          <input type="text" class="form-control" name="body_cover " placeholder="Body Cover">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Industrial Boots </label>
                            <input type="text" class="form-control" name="industrial_boots " placeholder="Industrial Boots">
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Eye Washer </label>
                          <input type="text" class="form-control" name="eye_washer " placeholder="Eye Washer  ">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Reported By</label>
                            <input type="text" class="form-control" name="reported_by " placeholder="Reported By">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Date </label>
                            <input type="date" class="form-control" name="date " placeholder="Date">
                        </div>
                        </div>

                      <button type="submit" class="btn btn-success me-2">Complete Man And Equipment Safety</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
