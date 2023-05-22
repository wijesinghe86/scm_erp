@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Employee Profile Details</h4>
                        <br>
                        <form class="forms-sample" method="POST" action="{{ route('employee.update',$employees->id) }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Employee Fullname</label>
                                    <input type="text" class="form-control" name="employee_fullname"
                                        placeholder="Employee Fullname" value="{{$employees->employee_fullname}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Employee Name with Initials</label>
                                    <input type="text" class="form-control" name="employee_name_with_intial"
                                        placeholder="Employee Name with Initials" value="{{$employees->employee_name_with_intial}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Employee Residential Address 1</label>
                                    <input type="text" class="form-control" name="residential_address_line1"
                                        placeholder="Employee Residential Address 1" value="{{$employees->residential_address_line1}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Employee Residential Address 2</label>
                                    <input type="text" class="form-control" name="residential_address_line2"
                                        placeholder="Employee Residential Address 2" value="{{$employees->residential_address_line2}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Employee Permanent Address 1</label>
                                    <input type="text" class="form-control" name="permanent_address_line1"
                                        placeholder="Employee Permanent Address 1" value="{{$employees->permanent_address_line1}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Employee Permanent Address 2</label>
                                    <input type="text" class="form-control" name="permanent_address_line2"
                                        placeholder="Employee Permanent Address 2" value="{{$employees->permanent_address_line2}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        placeholder="Date of Birth" value="{{$employees->date_of_birth}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" value="{{$employees->gender}}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($employees->gender =="1"?"selected":"") }} value="1">Male</option>
                                        <option {{ ($employees->gender =="2"?"selected":"") }} value="2">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Civil Status</label>
                                    <select class="form-control" name="civil_status" value="{{$employees->civil_status}}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($employees->civil_status =="1"?"selected":"") }} value="1">Married</option>
                                        <option {{ ($employees->civil_status =="2"?"selected":"") }} value="2">Single</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Employee Identity Number</label>
                                    <input type="text" class="form-control" name="identity_number"
                                        placeholder="Employee Identity Number" value="{{$employees->identity_number}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Employee Mobile Number</label>
                                    <input type="text" class="form-control" name="employee_mobile_number"
                                        placeholder="Employee Mobile Number" value="{{$employees->employee_mobile_number}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Employee Residential Phone Number</label>
                                    <input type="text" class="form-control" name="employee_residential_phone_number"
                                        placeholder="Employee Residential Phone Number" value="{{$employees->employee_residential_phone_number}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Employee email Address</label>
                                    <input type="email" class="form-control" name="employee_email"
                                        placeholder="Employee email Address" value="{{$employees->employee_email}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Employee Type</label>
                                    <select class="form-control" name="employee_type" value="{{$employees->employee_type}}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($employees->employee_type =="1"?"selected":"") }} value="1">Permanent</option>
                                        <option {{ ($employees->employee_type =="2"?"selected":"") }} value="2">Temporary</option>
                                        <option {{ ($employees->employee_type =="3"?"selected":"") }} value="3">Trainee</option>
                                        <option {{ ($employees->employee_type =="4"?"selected":"") }} value="4">Intern</option>
                                        <option {{ ($employees->employee_type =="5"?"selected":"") }} value="5">Contract</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Department</label>
                                    <input type="text" class="form-control" name="department" placeholder="Department" value="{{$employees->department}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Section</label>
                                    <input type="text" class="form-control" name="branch" placeholder="Section" value="{{$employees->branch}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Join Date</label>
                                    <input type="date" class="form-control" name="join_date" placeholder="Join Date" value="{{$employees->join_date}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{$employees->end_date}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Designation</label>
                                    <input type="text" class="form-control" name="designation"
                                        placeholder="Designation">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Remark</label>
                                    <input type="text" class="form-control" name="remark" placeholder="Remark" value="{{$employees->remark}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Role</label>
                                    <input type="text" class="form-control" name="role" placeholder="Role" value="{{$employees->role}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Responsibility</label>
                                    <input type="text" class="form-control" name="responsibility"
                                        placeholder="Responsibility" value="{{$employees->responsibility}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fleet Number</label>
                                    <input type="text" class="form-control" name="fleet_number"
                                        placeholder="Fleet Number" value="{{$employees->fleet_number}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Update</button>
                            <a href="{{ route('employee.all') }}" class="btn btn-primary me-2"> Previous </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
