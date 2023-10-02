@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Profile Creation</h4>
                        <form class="forms-sample" method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" name="customer_code"
                                        placeholder="Customer Code" value="{{ $next_number }}" readonly>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Customer Name *</label>
                                    <input type="text" class="form-control" name="customer_name"
                                        placeholder="Customer Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Business Registration Number *</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Business Registration Number" name="business_registration_number">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Vat Number *</label>
                                    <input type="text" class="form-control" name="customer_vat_number"
                                        placeholder="Vat Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SVat Number</label>
                                    <input type="text" class="form-control" name="customer_svat_number"
                                        placeholder="SVat Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Type *</label>
                                    <select class="form-control" name="customer_type_of_customer">
                                        <option value="">Select type</option>
                                        @foreach ($customer::$CUSTOMER_TYPE_LIST as $item)
                                            <option value="{{ $item['value'] }}">
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Address Line 1 *</label>
                                    <input type="text" class="form-control" name="customer_address_line1"
                                        placeholder="Address Line 1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Address Line2 *</label>
                                    <input type="text" class="form-control" name="customer_address_line2"
                                        placeholder="Address Line2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Mobile Phone Number *</label>
                                    <input type="text" class="form-control" name="customer_mobile_number"
                                        placeholder="Mobile Number">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fixed Phone Number</label>
                                    <input type="text" class="form-control" name="customer_fixed_phone_number"
                                        placeholder="FIxed Phone Number">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Customer E-mail</label>
                                    <input type="email" class="form-control" name="customer_email"
                                        placeholder="Customer E-mail">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Payment Terms *</label>
                                    <select class="form-control" name="customer_payment_terms">
                                        <option value="">Select type</option>
                                        @foreach ($customer::$PAYMENT_TERMS as $item)
                                            <option value="{{ $item['value'] }}">
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Credit Limit </label>
                                    <input type="text" class="form-control" name="customer_credit_limit"
                                        placeholder="Customer Credit Limit">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Credit Period</label>
                                    <select class="form-control" name="customer_credit_period">
                                        <option value="">Select</option>
                                        @foreach ($customer::$CREDIT_PERIODS as $item)
                                            <option value="{{ $item['value'] }}">{{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Contact Person Name</label>
                                    <input type="text" class="form-control" name="customer_contact_person_name"
                                        placeholder="Contact Person Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact Person Mobile Phone Number</label>
                                    <input type="text" class="form-control" name="customer_contact_person_mobile_number"
                                        placeholder="Contact Person Mobile Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Contact Person Email</label>
                                    <input type="email" class="form-control" name="customer_contact_person_email"
                                        placeholder="Contact Person Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Customer Status</label>
                                    <select class="form-control" name="customer_status">
                                        <option value="">Select</option>
                                        <option selected value="1">Active</option>
                                        <option value="2">In-Active</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>BR Image</label>
                                    <input type="file" name="br_image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload BR image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-primary me-2"> Cancel </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
