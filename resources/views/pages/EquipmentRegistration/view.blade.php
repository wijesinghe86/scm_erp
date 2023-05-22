@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Equipment Registration Details View</h4>
          <form class="forms-sample" method="POST" action="{{ route('equipmentregistration.store') }}">
              @csrf
              <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Equipment Code</label>
                            <span>{{$equipmentregistrations->equipment_code}}</span>
                            </div>
                        <div class="form-group col-md-6">
                            <label>Stock Number</label>
                            <span>{{$equipmentregistrations->stock_number}}</span>
                           </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-md-6">
                            <label>Equipment Name</label>
                            <span>{{$equipmentregistrations->equipment_name}}</span>
                             </div>
                        <div class="form-group col-md-6">
                          <label>Purchase Order Number</label>
                          <span>{{$equipmentregistrations->po_number}}</span>
                          </div>
                        </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Goods Receiving Number</label>
                            <span>{{$equipmentregistrations->grn_number}}</span>
                            </div>
                        <div class="form-group col-md-6">
                            <label>Equipment Description</label>
                            <span>{{$equipmentregistrations->equipment_description}}</span>
                        </div>
                    </div>

                    <div class="row">
                    <div class="form-group col-md-6">
                            <label>Equipment Type</label>
                            <span>{{$equipmentregistrations->equipment_type}}</span>
                        </div>
                        {{-- <div class="form-group col-md-4">
                            <label>Condition</label>
                            <input type="text" class="form-control" name="condition" placeholder="Condition">
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label>Power Source </label>
                            <span>{{$equipmentregistrations->power_source}}</span>
                        </div>
                    </div>
                <a href="{{ route('equipmentregistration.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

