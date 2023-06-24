@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Material Request Approval Form</h4>
                        <form class="forms-sample" method="POST" action="{{ route('raw_material_request_approve.store') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-2">
                                  <label>Raw Material Request No</label>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Requested By</label>
                                    <input type="text" readonly class="form-control" name="requested_by" id="requested_by" >
                                  </div>
                                  <div class="form-group col-md-3">
                                    <label>Required Date</label>
                                    <input type="date" readonly class="form-control" name="required_date" id="required_date">
                                  </div>
                            </div>

                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <button class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
