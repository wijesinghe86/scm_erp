@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Operation Mechanism By Product Creation</h4>
                    <form class="forms-sample" method="POST" action="{{ route('operationmechanismbyproduct.store') }}">
                    @csrf
                    <br><br>
                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" placeholder="Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Production Planning Schedule Number</label>
                            <input type="text" class="form-control" name="production_planning_schedule_number" placeholder="Production Planning Schedule Number">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Job Order Number</label>
                            <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                            <label>Product Kind</label>
                            <input type="text" class="form-control" name="product_kind" placeholder="Product Kind">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Time period</label>
                            <input type="text" class="form-control" name="time_period " placeholder="Time period">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Coefficient of Product</label>
                          <input type="text" class="form-control" name="coefficient_of_product" placeholder="Coefficient of Product">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ordered Quantity</label>
                            <input type="number" class="form-control" name="ordered_quantity " placeholder="Ordered Quantity">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Inventory Quantity</label>
                            <input type="number" class="form-control" name="inventory_quantity" placeholder="Inventory Quantity">
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group col-md-4">
                            <label>WIP Quantity</label>
                            <input type="number" class="form-control" name="wip_quantity " placeholder="WIP Quantity">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Overall Inventory Target</label>
                            <input type="text" class="form-control" name="overall_inventory_target" placeholder="Overall Inventory Target">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Front area WIP Quantity</label>
                            <input type="number" class="form-control" name="front_area_wip_quantity" placeholder="Front area WIP Quantity">
                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Back Area Quantity</label>
                                <input type="number" class="form-control" name="back_area_quantity" placeholder="Back Area Quantity">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tolerant Start Time of Operation</label>
                                <input type="text" class="form-control" name="tolerant_start_time_of_operation" placeholder="Tolerant Start Time of Operation">
                            </div>
                            </div>

                      <button type="submit" class="btn btn-success me-2">Complete Operation Mechanism By Product</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
