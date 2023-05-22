@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tax Creation Master</h4>
                        <form class="forms-sample" method="POST" action="{{ route('taxcreation.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Tax Code</label>
                                    <input type="text" class="form-control" name="tax_code" placeholder="Tax Code" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tax Name</label>
                                    <input type="text" class="form-control" name="tax_name" placeholder="Tax Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tax Rate %</label>
                                    <input type="number" class="form-control" name="tax_rate" placeholder="Tax Rate %">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tax Description</label>
                                    <input type="text" class="form-control" name="tax_description"
                                        placeholder="Tax Description">
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Expire Date</label>
                                    <input type="date" class="form-control" name="expire_date" placeholder="Expire Date">
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
