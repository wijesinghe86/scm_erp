@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Equipment Registration Master</h4>
          <form class="forms-sample" method="POST" action="{{ route('equipmentregistration.store') }}">
              @csrf
              <br>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Equipment Code</label>
                        <input type="text" class="form-control" name="equipment_code" placeholder="Equipment Code" value="{{$next_number}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Equipment Name</label>
                        <input type="text" class="form-control" name="equipment_name" placeholder="Equipment Name">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                      <label>Purchase Order Number</label>
                      <input type="text" class="form-control" name="po_number" placeholder="Purchase Order Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Goods Receiving Number</label>
                        <input type="text" class="form-control" name="grn_number" placeholder="Goods Receiving Number">
                    </div>
                  </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Equipment Description</label>
                        <input type="text" class="form-control" name="equipment_description" placeholder="Equipment Description">
                    </div>
                </div>

                <div class="row">
                <div class="form-group col-md-4">
                        <label>Equipment Type</label>
                        <SELECT name="equipment_type" class="form-control"><option value=""> Select </option>
                            <option value="1">Physical</option>
                            <option value="2">Chemical</option>
                            <option value="3">Mechanical</option>
                        </SELECT>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label>Condition</label>
                        <input type="text" class="form-control" name="condition" placeholder="Condition">
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label>Power Source </label>
                        <SELECT name="power_source " class="form-control">
                            <option value=""> Select </option>
                            <option value="1">Electric</option>
                            <option value="2">Solar</option>
                            <option value="3">Diesel</option>
                            <option value="4">Battery</option>
                        </SELECT>
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

