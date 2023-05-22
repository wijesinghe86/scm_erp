@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Warehouse Safety Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('warehousesafety.store') }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Exit Land </label>
                          <input type="text" class="form-control" name="exitland " placeholder="Exit Land">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Entrance Land  </label>
                          <input type="text" class="form-control" name="entranceland  " placeholder="Entrance Land">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Entrance Light  </label>
                            <input type="text" class="form-control" name="entrancelight   " placeholder="Entrance Light">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Exit Light </label>
                            <input type="text" class="form-control" name="exitlight   " placeholder="Exit Light">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Excess Fan  </label>
                          <input type="text" class="form-control" name="excessfan  " placeholder="Excess Fan">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fire Hydrant  </label>
                            <input type="text" class="form-control" name="firehydrant" placeholder="Fire Hydrant ">
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Fire Cylinder  </label>
                          <input type="text" class="form-control" name="firecylinder" placeholder="Fire Cylinder ">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Safety Warning</label>
                            <input type="text" class="form-control" name="safetywarning" placeholder="Safety Warning">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Danger Materials </label>
                            <input type="text" class="form-control" name="dangermaterials  " placeholder="Danger Materials">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Racking System  </label>
                            <input type="text" class="form-control" name="rackingsystem  " placeholder="Racking System">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fire trail  </label>
                            <input type="text" class="form-control" name="firetrail  " placeholder="fire trail">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Fire Alarm </label>
                            <input type="text" class="form-control" name="firealarm" placeholder="Fire Alarm ">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Electrical Issue </label>
                            <input type="text" class="form-control" name="electricalissue   " placeholder="Electrical Issue">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Reported By</label>
                            <input type="text" class="form-control" name="reported_by " placeholder="Reported By">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Date </label>
                            <input type="date" class="form-control" name="date " placeholder="Date">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Complete Warehouse Safety</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
