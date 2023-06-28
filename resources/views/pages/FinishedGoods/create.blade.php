@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Finished Goods Entry Note</h4>
                        <form class="forms-sample" method="POST" action="{{ route('finishedgoods.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="fgrn_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>FGRN No</label>
                                    <input type="text" class="form-control" name="fgrn_no"
                                        placeholder="FGRN_No">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse</label>
                                    <select class="form-control item-select" name="warehouse_code">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Production_Start Date_Time</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Production_End Date_Time</label>
                                    <input type="date" class="form-control" name="end_date"
                                        placeholder="Batch Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>RMI No</label>
                                    <input type="text" class="form-control" name="rmi_no"
                                        placeholder="RMI_No">
                                </div>
                            </div>
                            <hr>
                            <h5>Wastage Enry</h5>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock No</label>
                                    <input type="text" class="form-control" name="stock_no">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <select class="form-control item-select" name="stock_item">
                                        @foreach ($stocks as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2" name="button" value="add">Add</button>
                            <table class="table bordered">
                                <thead>
                                    <tr>
                                        <th>Stock No</th>
                                        <th>Description</th>
                                        <th>U/M</th>
                                        <th>Qty</th>
                                        <th>Weight</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Issued Weight</label>
                                    <input type="text" class="form-control" name="tot_issued_weight">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Production Qty</label>
                                    <input type="text" class="form-control" name="tot_pro_qty">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Production Weight</label>
                                    <input type="text" class="form-control" name="tot_pro_weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Wastage</label>
                                    <input type="text" class="form-control" name="tot_waste">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remaining Raw Materials</label>
                                    <input type="text" class="form-control" name="remaining">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Complete Finished Goods</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
