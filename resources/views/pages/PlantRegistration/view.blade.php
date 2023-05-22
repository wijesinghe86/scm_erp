@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Plant Registration Details View</h4>
                    <form class="forms-sample" method="POST" action="{{ route('PlantRegistration.store') }}">
                      <!-- <div class="form-group">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                      </div> -->
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Plant Number :</label>
                          <span>{{$plantregistrations->plant_number}}</span>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Plant Name :</label>
                          <span>{{$plantregistrations->plant_name}}</span>
                          </div>
                        </div>

                          <div class="row">
                        <div class="form-group col-md-6">
                          <label>Plant Type :</label>
                          <span>{{$plantregistrations->plant_type}}</span>
                           </div>
                        <div class="form-group col-md-6">
                          <label>Plant Serial Number :</label>
                          <span>{{$plantregistrations->plant_serial_number}}</span>
                           </div>
                        </div>

                           <div class="row">
                        <div class="form-group col-md-6">
                          <label>Model Number :</label>
                          <span>{{$plantregistrations->model_number}}</span>
                          </div>
                        <div class="form-group col-md-6">
                          <label>Manufactor Number :</label>
                          <span>{{$plantregistrations->manufactor_number}}</span>
                            </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Capacity :</label>
                          <span>{{$plantregistrations->capacity}}</span>
                         </div>
                        <div class="form-group col-md-6">
                          <label>Maintenance Period :</label>
                          <span>{{$plantregistrations->maintenance_period}}</span>
                          </div>
                        </div>

                          <div class="row">
                        <div class="form-group col-md-6">
                          <label>Technical Specification :</label>
                          <span>{{$plantregistrations->technical_specification}}</span>
                             </div>
                             <div class="form-group col-md-6">
                          <label>Electrical & Electronical Specification :</label>
                          <span>{{$plantregistrations->electricalandelectronical_specification}}</span>
                            </div>
                        </div>

                            <div class="row">
                        <div class="form-group col-md-6">
                          <label>Electronic Specification :</label>
                          <span>{{$plantregistrations->electronic_specification}}</span>
                            </div>
                        <div class="form-group col-md-6">
                          <label>Manual Operation Specification :</label>
                          <span>{{$plantregistrations->manual_operation_specification}}</span>
                           </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Maintaining Guide :</label>
                          <span>{{$plantregistrations->maintaining_guide}}</span>
                           </div>
                        <div class="form-group col-md-6">
                          <label>Operation Methods :</label>
                          <span>{{$plantregistrations->operation_methods}}</span>
                          </div>
                        </div>

                          <div class="row">
                        <div class="form-group col-md-6">
                          <label>Analytical Manual :</label>
                          <span>{{$plantregistrations->analytical_manual}}</span>
                           </div>
                        <div class="form-group col-md-6">
                          <label>Vendors Instruction Manual :</label>
                          <span>{{$plantregistrations->vendors_instruction_manual}}</span>
                          </div>
                        </div>

                          <div class="row">
                        <div class="form-group col-md-6">
                          <label>Safety Manual :</label>
                          <span>{{$plantregistrations->safety_manual}}</span>
                           </div>
                        <div class="form-group col-md-6">
                          <label>Purchase Date :</label>
                          <span>{{$plantregistrations->purchase_date}}</span>
                          </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Purchase Order Number :</label>
                          <span>{{$plantregistrations->po_number}}</span>
                          </div>
                        <div class="form-group col-md-6">
                          <label>Asset Code :</label>
                          <span>{{$plantregistrations->asset_code}}</span>
                             </div>
                            </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                          <label>Warehouse Code :</label>
                          <span>{{$plantregistrations->warehouse_code}}</span>
                             </div>
                        <div class="form-group col-md-6">
                          <label>Condition :</label>
                          <span>{{$plantregistrations->condition}}</span>
                         </div>
                        </div>

                         <div class="row">
                        <div class="form-group col-md-6">
                          <label>Tag Number :</label>
                          <span>{{$plantregistrations->tag_number}}</span>
                          </div>
                        <div class="form-group col-md-6">
                          <label>Size :</label>
                          <span>{{$plantregistrations->size}}</span>
                           </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Weight :</label>
                          <span>{{$plantregistrations->weight}}</span>
                           </div>

                        <div class="form-group col-md-6">
                          <label>Output :</label>
                          <span>{{$plantregistrations->output}}</span>
                          </div>
                      </div>

                      <a href="{{ route('PlantRegistration.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>
                      @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  @endsection
