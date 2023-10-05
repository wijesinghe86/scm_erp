@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Plant Registration</h4>
                    <form class="forms-sample" method="POST" action="{{ route('plantregistration.update',$plantregistrations->id) }}">
                      <!-- <div class="form-group">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                      </div> -->
                      <br>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Plant Number</label>
                          <input type="text" class="form-control" name="plant_number" placeholder="Plant Number" value="{{$plantregistrations->plant_number}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Plant Name</label>
                          <input type="text" class="form-control" name="plant_name" placeholder="Plant Name" value="{{$plantregistrations->plant_name}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Plant Type</label>
                          <input type="text" class="form-control" name="plant_type" placeholder="Plant Type" value="{{$plantregistrations->plant_type}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Plant Serial Number </label>
                          <input type="text" class="form-control" name="plant_serial_number" placeholder="Plant Serial Number" value="{{$plantregistrations->plant_serial_number}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Model Number</label>
                          <input type="text" class="form-control" name="model_number" placeholder="Model Number" value="{{$plantregistrations->model_number}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Manufactor Number</label>
                          <input type="text" class="form-control" name="manufactor_number" placeholder="Manufactor Number" value="{{$plantregistrations->manufactor_number}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Capacity</label>
                          <input type="text" class="form-control" name="capacity" placeholder="Capacity" value="{{$plantregistrations->capacity}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Maintenance Period</label>
                          <input type="text" class="form-control" name="maintenance_period" placeholder="Maintenance Period" value="{{$plantregistrations->maintenance_period}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Technical Specification</label>
                          <input type="text" class="form-control" name="technical_specification" placeholder="Technical Specification" value="{{$plantregistrations->technical_specification}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Electrical & Electronical Specification</label>
                          <input type="text" class="form-control" name="electricalandelectronical_specification" placeholder="Electrical & Electronical Specification" value="{{$plantregistrations->electricalandelectronical_specification}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Electronic Specification</label>
                          <input type="text" class="form-control" name="electronic_specification" placeholder="Electronic Specification" value="{{$plantregistrations->electronic_specification}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Manual Operation Specification</label>
                          <input type="text" class="form-control" name="manual_operation_specification" placeholder="Manual Operation Specification" value="{{$plantregistrations->manual_operation_specification}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Maintaining Guide</label>
                          <input type="text" class="form-control" name="maintaining_guide" placeholder="Maintaining Guide" value="{{$plantregistrations->maintaining_guide}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Operation Methods</label>
                          <input type="text" class="form-control" name="operation_methods" placeholder="Operation Methods" value="{{$plantregistrations->operation_methods}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Analytical Manual</label>
                          <input type="text" class="form-control" name="analytical_manual" placeholder="Analytical Manual" value="{{$plantregistrations->analytical_manual}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Vendors Instruction Manual</label>
                          <input type="text" class="form-control" name="vendors_instruction_manual" placeholder="Vendors Instruction Manual" value="{{$plantregistrations->vendors_instruction_manual}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Safety Manual</label>
                          <input type="text" class="form-control" name="safety_manual" placeholder="Safety Manual" value="{{$plantregistrations->safety_manual}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Purchase Date</label>
                          <input type="date" class="form-control" name="purchase_date" placeholder="Purchase Date" value="{{$plantregistrations->purchase_date}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Purchase Order Number</label>
                          <input type="text" class="form-control" name="po_number" placeholder="Purchase Order Number" value="{{$plantregistrations->po_number}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Asset Code</label>
                          <input type="text" class="form-control" name="asset_code" placeholder="Asset Code" value="{{$plantregistrations->asset_code}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Warehouse Code</label>
                          <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code" value="{{$plantregistrations->warehouse_code}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Condition</label>
                          <input type="text" class="form-control" name="condition" placeholder="Condition" value="{{$plantregistrations->condition}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Tag Number</label>
                          <input type="text" class="form-control" name="tag_number" placeholder="Tag Number" value="{{$plantregistrations->tag_number}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Size</label>
                          <input type="text" class="form-control" name="size" placeholder="Size" value="{{$plantregistrations->size}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Weight</label>
                          <input type="text" class="form-control" name="weight" placeholder="Weight" value="{{$plantregistrations->weight}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Output</label>
                          <input type="text" class="form-control" name="output" placeholder="Output" value="{{$plantregistrations->output}}">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Update</button>
                      <a href="{{ route('PlantRegistration.index') }}" class="btn btn-primary me-2"> Previous </a>
                      @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  @endsection
