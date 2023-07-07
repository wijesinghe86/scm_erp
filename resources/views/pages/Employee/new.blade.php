@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Employee Profile Creation</h4>
                        <br>
                        <form class="forms-sample" method="POST" action="{{ route('employee.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Employee Registration No</label>
                                    <input type="text" class="form-control" name="employee_reg_no"
                                        placeholder="Employee Registration No" value="{{$next_number}}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>EPF No</label>
                                    <input type="text" class="form-control" name="employee_epf_no" placeholder="EPF No">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fullname *</label>
                                    <input type="text" class="form-control" name="employee_fullname"
                                        placeholder="Employee Fullname">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Name with Initials </label>
                                    <input type="text" class="form-control" name="employee_name_with_intial"
                                        placeholder="Employee Name with Initials">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Residential Address Line 1</label>
                                    <input type="text" class="form-control" name="residential_address_line1"
                                        placeholder="Employee Residential Address Line 1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Residential Address line 2</label>
                                    <input type="text" class="form-control" name="residential_address_line2"
                                        placeholder="Employee Residential Address Line 2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Postal Address Line 1</label>
                                    <input type="text" class="form-control" name="postal_address_line1"
                                        placeholder="Employee Postal Address Line 1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Postal Address Line 2</label>
                                    <input type="text" class="form-control" name="postal_address_line2"
                                        placeholder="Employee Postal Address Line 2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        placeholder="Date of Birth">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Gender *</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Select type</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Civil Status *</label>
                                    <select class="form-control" name="civil_status">
                                        <option value="">Select type</option>
                                        <option value="1">Married</option>
                                        <option value="2">Single</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>NIC Number</label>
                                    <input type="text" class="form-control" name="employee_nic_no"
                                        placeholder="Employee Identity Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="employee_mobile_number"
                                        placeholder="Employee Mobile Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Residential Phone Number</label>
                                    <input type="text" class="form-control" name="employee_residential_phone_number"
                                        placeholder="Employee Residential Phone Number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>email Address</label>
                                    <input type="email" class="form-control" name="employee_email"
                                        placeholder="Employee email Address">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Employee Type *</label>
                                    <select class="form-control item-select" name="employee_type">
                                        <option value="">Select Type</option>
                                        <option value="1">Permanent</option>
                                        <option value="2">Temporary</option>
                                        <option value="3">Trainee</option>
                                        <option value="4">Intern</option>
                                        <option value="5">Contract</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Department</label>
                                    <select class="form-control item-select" name="department">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->department_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" name="department" placeholder="Department"> --}}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Section</label>
                                    <select class="form-control item-select" name="section">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" name="branch" placeholder="Section"> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Join Date</label>
                                    <input type="date" class="form-control" name="join_date" placeholder="Join Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Working Date</label>
                                    <input type="date" class="form-control" name="last_date"
                                        placeholder="Last Working Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Designation</label>
                                    <input type="text" class="form-control" name="designation"
                                        placeholder="Designation">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="remark" placeholder="Remarks">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Role *</label>
                                    <select class="form-control" name="role">
                                        <option value="">Select Type</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Manager</option>
                                        <option value="4">Department Head</option>
                                        <option value="5">Section Head</option>
                                        <option value="6">Supervisor</option>
                                        <option value="7">Executive</option>
                                        <option value="8">Non-Executive</option>
                                        <option value="9">Data Entry</option>
                                        <option value="10">Labour</option>

                                    </select>
                                    </div>
                                <div class="form-group col-md-3">
                                    <label>Responsibility</label>
                                    <input type="text" class="form-control" name="responsibility"
                                        placeholder="Responsibility">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fleet Registration Number</label>
                                    <select class="form-control item-select" name="fleet_number">
                                        @foreach ($fleets as $fleet)
                                            <option value="{{ $fleet->id }}">{{ $fleet->fleet_registration_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Status</label>
                                    <select class="form-control" name="employee_status">
                                        <option value="">Select Type</option>
                                        <option value="1">Active</option>
                                        <option value="2">InActive</option>
                                    </select>
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
@push('styles')
    <style>
        .select2-container .select-selection--single {
            height: 46px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.item_select').select2({
                placeholder: "select item,"
            });

        });
    </script>
@endpush
