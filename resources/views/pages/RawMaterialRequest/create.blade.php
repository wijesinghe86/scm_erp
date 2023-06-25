@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Materials Request Form Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('raw_material_request.store') }}">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Request No</label>
                                    <input type="text" class="form-control" name="req_no" value="{{ old('req_no') }}"
                                        placeholder="Req No">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Request Date</label>
                                    <input type="date" class="form-control" name="req_date" value="{{ old('req_date') }}"
                                        placeholder="Req date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Requested By</label>
                                    <select class="form-control" name="requested_by" placeholder="Reqested By"
                                        value="{{ old('requested_by') }}">
                                           @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"> {{ $employee->employee_fullname }} -
                                                {{ $employee->departmentData->department_name }}
                                                ({{ $employee->sectionData->section_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Required Date</label>
                                    <input type="date" class="form-control" name="required_date"
                                        value="{{ old('required_date') }}" id="required_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7">
                                    <label>Justification</label>
                                    <input type="text" class="form-control" name="justification"
                                        value="{{ old('justification') }}" placeholder="Justification">  
                            </div>
                                <div class="form-group col-md-2">
                                    <label>Job Order No</label>
                                    <select class="form-control" name="job_no" id="job_no">
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Plant</label>
                                    <input type="text" class="form-control" name="plant"
                                        value="{{ old('plant') }}" placeholder="Plant">
                                </div>
                            </div>






                            <button type="submit" class="btn btn-success me-2" name="button" value="complete">Complete
                                Materials Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
