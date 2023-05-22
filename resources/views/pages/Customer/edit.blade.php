@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Customer Profile Edit</h4>
                        <form class="forms-sample" action="{{ route('customer.update', $customers->id)}}"  method="POST">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" name="customer_code" value="{{ $customers->customer_code }}"
                                        placeholder="Customer Code">
                                </div>
                                <div class="form-group col-md-10">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" value="{{ $customers->customer_name }}"
                                        placeholder="Customer Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Vat Number</label>
                                    <input type="text" class="form-control" name="customer_vat_number"
                                    value="{{ $customers->customer_vat_number }}" placeholder="Vat Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SVat Number</label>
                                    <input type="text" class="form-control" name="customer_svat_number"
                                    value="{{ $customers->customer_svat_number }}" placeholder="SVat Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Type</label>
                                    <select class="form-control" name="customer_type_of_customer" value="{{ $customers->customer_type_of_customer }}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($customers->customer_type_of_customer =="1"?"selected":"") }} value="1">Cash</option>
                                        <option {{ ($customers->customer_type_of_customer =="2"?"selected":"") }} value="2">Credit</option>
                                        <option {{ ($customers->customer_type_of_customer =="3"?"selected":"") }} value="3">Distributor</option>
                                        <option {{ ($customers->customer_type_of_customer =="4"?"selected":"") }} value="4">Debtor</option>
                                        <option {{ ($customers->customer_type_of_customer =="5"?"selected":"") }} value="3">Fleet Owner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Address Line 1</label>
                                    <input type="text" class="form-control" name="customer_address_line1"
                                    value="{{ $customers->customer_address_line1 }}"
                                        placeholder="Address Line 1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>address Line2</label>
                                    <input type="text" class="form-control" name="customer_address_line2"
                                    value="{{ $customers->customer_address_line2 }}" placeholder="address Line2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="customer_mobile_number" value="{{ $customers->customer_mobile_number }}"
                                        placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fixed Phone Number</label>
                                    <input type="text" class="form-control" name="customer_fixed_phone_number" value="{{ $customers->customer_fixed_phone_number }}"
                                        placeholder="FIxed Phone Number">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Customer E-mail</label>
                                    <input type="email" class="form-control" name="customer_email" value="{{ $customers->customer_email }}"
                                        placeholder="Customer E-mail">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Payment Terms</label>
                                    <select class="form-control" name="customer_payment_terms" value="{{ $customers->customer_payment_terms }}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($customers->customer_payment_terms =="1"?"selected":"") }} value="1">Cash</option>
                                        <option {{ ($customers->customer_payment_terms =="2"?"selected":"") }} value="2">Credit</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Credit Limit</label>
                                    <input type="text" class="form-control" name="customer_credit_limit" value="{{ $customers->customer_credit_limit }}"
                                        placeholder="Customer E-mail">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Credit Period</label>
                                    <select class="form-control" name="customer_credit_period" {{ $customers->customer_credit_period }}>
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($customers->customer_credit_period =="1"?"selected":"") }} value="1">30 Days</option>
                                        <option {{ ($customers->customer_credit_period =="2"?"selected":"") }} value="2">60 Days</option>
                                        <option {{ ($customers->customer_credit_period =="3"?"selected":"") }} value="3">90 Days</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Contact Person Name</label>
                                    <input type="text" class="form-control" name="customer_contact_person_name" value="{{ $customers->customer_contact_person_name }}"
                                        placeholder="Contact Person Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact Person Mobile Number</label>
                                    <input type="text" class="form-control" name="customer_contact_person_mobile_number" value="{{ $customers->customer_contact_person_mobile_number }}"
                                        placeholder="Contact Person Mobile Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact Person Email</label>
                                    <input type="email" class="form-control" name="customer_contact_person_email" value="{{ $customers->customer_contact_person_email }}"
                                        placeholder="Contact Person Email">
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="form-group col-md-4">
                                    <label>Customer Status</label>
                                    <select class="form-control" name="customer_status" {{ $customers->customer_status }} >
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($customers->Active =="1"?"selected":"") }} value="1">Active</option>
                                        <option {{ ($customers->InActive =="2"?"selected":"") }} value="2">In-Active</option>
                                    </select>
                                </div> --}}
                                <div class="form-group col-md-8">
                                    <label>BR Image</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload BR image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success me-2">Update</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-primary me-2"> Previous </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


