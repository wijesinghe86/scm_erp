@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Details View</h4>
                        <form class="forms-sample">
                            @csrf
                            <div class="form-group col-md-12">
                                <label>Employee Reg No : </label>
                                <label>{{ $employees->employee_reg_no }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>EPF No : </label>
                                <label>{{ $employees->employee_epf_no }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Fullname : </label>
                                <label>{{ $employees->employee_fullname }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Name with Initials : </label>
                                <label>{{ $employees->employee_name_with_intial }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Residential Address 1 : </label>
                                <label>{{ $employees->residential_address_line1 }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Residential Address 2 : </label>
                                <label>{{ $employees->residential_address_line2 }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Permanent Address 1 : </label>
                                <label>{{ $employees->postal_address_line1 }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Permanent Address 2 : </label>
                                <label>{{ $employees->postal_address_line2 }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Date of Birth : </label>
                                <label>{{ $employees->date_of_birth }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Gender : </label>
                                <label>{{ $employees->gender }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Civil Status : </label>
                                <label>{{ $employees->civil_status }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Identity Number : </label>
                                <label>{{ $employees->employee_nic_no }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Mobile Number : </label>
                                <label>{{ $employees->employee_mobile_number }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Residential Phone Number : </label>
                                <label>{{ $employees->employee_residential_phone_number }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee email Address : </label>
                                <label>{{ $employees->employee_email }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Employee Type : </label>
                                <label>{{ $employees->employee_type }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Department : </label>
                                <label>{{ $employees->department }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Sectiion : </label>
                                <label>{{ $employees->section }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Join Date : </label>
                                <label>{{ $employees->join_date }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>End Date : </label>
                                <label>{{ $employees->last_date }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Designation : </label>
                                <label>{{ $employees->designation }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Remark : </label>
                                <label>{{ $employees->remark }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Role : </label>
                                <label>{{ $employees->role }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Responsibility : </label>
                                <label>{{ $employees->responsibility }}</label>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Fleet Number : </label>
                                <label>{{ $employees->fleet_number }}</label>
                            </div>

                            <a href="{{ route('employee.all') }}" class="btn btn-primary float-end mb-2"> Previous</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
