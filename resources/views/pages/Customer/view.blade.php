@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Customer  Profile</h4>
                        <form class="forms-sample">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Customer Code :</label>
                                    <span>{{$customers->customer_code}}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Customer Name :</label>
                                    <span>{{$customers->customer_name}}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Business Registration Number :</label>
                                    <span>{{$customers->business_registration_number}}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Vat Number :</label>
                                    <span>{{$customers->customer_vat_number}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>S Vat Number :</label>
                                    <span>{{$customers->customer_svat_number}}</span>
                                    </div>
                                <div class="form-group col-md-6">
                                    <label>Customer Type :</label>
                                    <span>{{$customers->customer_type_of_customer}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Address Line 1 :</label>
                                    <span>{{$customers->customer_address_line1}}</span>
                                    </div>
                                <div class="form-group col-md-6">
                                    <label>Address Line2 :</label>
                                    <span>{{$customers->customer_address_line2}}</span>
                                     </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Mobile Phone Number :</label>
                                    <span>{{$customers->customer_mobile_number}}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fixed Phone Number :</label>
                                    <span>{{$customers->customer_fixed_phone_number}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Customer E-mail :</label>
                                    <span>{{$customers->customer_email}}</span>
                                     </div>
                                <div class="form-group col-md-6">
                                    <label>Payment Terms :</label>
                                    <span>{{$customers->customer_payment_terms}}</span>
                                     </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Credit Limit :</label>
                                    <span>{{$customers->customer_credit_limit}}</span>
                                     </div>
                                <div class="form-group col-md-6">
                                    <label>Credit Period :</label>
                                    <span>{{$customers->customer_credit_period}}</span>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Contact Person Name :</label>
                                    <span>{{$customers->customer_contact_person_name}}</span>
                                    </div>
                                <div class="form-group col-md-6">
                                    <label>Contact Person Mobile Phone Number :</label>
                                    <span>{{$customers->customer_contact_person_mobile_number}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Contact Person Email :</label>
                                    <span>{{$customers->customer_contact_person_email}}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Customer Status :</label>
                                    <span>{{$customers->customer_status}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>BR Image :</label>
                                    <span>{{$customers->br_image}}</span>
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload BR image">
                                            <span>{{$customers->br_image}}</span>

                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('customer.index') }}" class="btn btn-primary float-end mb-2"> Previous </a>

                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


