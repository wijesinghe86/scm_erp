@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Plant Registration Master</h4>
                    <form class="forms-sample" method="POST" action="{{ route('PlantRegistration.store') }}">
                      <!-- <div class="form-group">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                      </div> -->
                      <br>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Plant Number</label>
                          <input type="text" class="form-control" name="plant_number" placeholder="Plant Number" value="{{$next_number}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Plant Name</label>
                          <input type="text" class="form-control" name="plant_name" placeholder="Plant Name">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Plant Type</label>
                          <input type="text" class="form-control" name="plant_type" placeholder="Plant Type">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Plant Serial Number </label>
                          <input type="text" class="form-control" name="plant_serial_number" placeholder="Plant Serial Number">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Model Number</label>
                          <input type="text" class="form-control" name="model_number" placeholder="Model Number">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Manufactor Number</label>
                          <input type="text" class="form-control" name="manufactor_number" placeholder="Manufactor Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Capacity</label>
                          <input type="text" class="form-control" name="capacity" placeholder="Capacity">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Maintenance Period</label>
                          <input type="text" class="form-control" name="maintenance_period" placeholder="Maintenance Period">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Technical Specification</label>
                          <input type="text" class="form-control" name="technical_specification" placeholder="Technical Specification">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Electrical & Electronical Specification</label>
                          <input type="text" class="form-control" name="electricalandelectronical_specification" placeholder="Electrical & Electronical Specification">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Electronic Specification</label>
                          <input type="text" class="form-control" name="electronic_specification" placeholder="Electronic Specification">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Manual Operation Specification</label>
                          <input type="text" class="form-control" name="manual_operation_specification" placeholder="Manual Operation Specification">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Maintaining Guide</label>
                          <input type="text" class="form-control" name="maintaining_guide" placeholder="Maintaining Guide">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Operation Methods</label>
                          <input type="text" class="form-control" name="operation_methods" placeholder="Operation Methods">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Analytical Manual</label>
                          <input type="text" class="form-control" name="analytical_manual" placeholder="Analytical Manual">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Vendors Instruction Manual</label>
                          <input type="text" class="form-control" name="vendors_instruction_manual" placeholder="Vendors Instruction Manual">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Safety Manual</label>
                          <input type="text" class="form-control" name="safety_manual" placeholder="Safety Manual">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Purchase Date</label>
                          <input type="date" class="form-control" name="purchase_date" placeholder="Purchase Date">
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
                        <div class="form-group col-md-4">
                          <label>Asset Code</label>
                          <input type="text" class="form-control" name="asset_code" placeholder="Asset Code">
                        </div>
                      </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        {{-- <input type="text" class="form-control" name="warehouse_code" placeholder="Warehouse Code"> --}}
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Condition</label>
                          <input type="text" class="form-control" name="condition" placeholder="Condition">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Tag Number</label>
                          <input type="text" class="form-control" name="tag_number" placeholder="Tag Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Size</label>
                            <input type="number" class="form-control" name="size" placeholder="Size">
                          </div>
                        <div class="form-group col-md-4">
                          <label>Weight</label>
                          <input type="number" class="form-control" name="weight" placeholder="Weight">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Output</label>
                          <input type="text" class="form-control" name="output" placeholder="Output">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2">Submit</button>
                      @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  @endsection
