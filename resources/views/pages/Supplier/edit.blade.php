@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"> Edit Supplier Profile Creation</h1>
                    <br>
                        <form class="forms-sample" action="{{ route('supplier.update',$suppliers->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="">Supplier Code</label>
                                    <input type="text" class="form-control" id="" placeholder="Supplier Code" name="supplier_code" value="{{$suppliers->supplier_code}}" readonly>
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="">Supplier Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Supplier Name" name="supplier_name" value="{{$suppliers->supplier_name}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Business Registration Number</label>
                                    <input type="text" class="form-control" id="" placeholder="Business Registration Number" name="business_registration_number" value="{{$suppliers->business_registration_number}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Business Registration Image</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Business Registration Image" name="business_registration_image" value="{{$suppliers->business_registration_image}}">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-info" type="button">Upload</button>
                                    </span>
                                </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Supplier Registration Type</label>
                                    <select class="form-control" id="" name="supplier_registration_type" value="{{$suppliers->supplier_registration_type}}">
                                        <option selected disabled>Select Status</option>
                                        <option  {{ ($suppliers->supplier_registration_type =="1"?"selected":"") }} value="1">Sole Proprietorship </option>
                                        <option  {{ ($suppliers->supplier_registration_type =="2"?"selected":"") }} value="2">Partnership</option>
                                        <option  {{ ($suppliers->supplier_registration_type =="3"?"selected":"") }} value="3">Private Limited Company</option>
                                        <option  {{ ($suppliers->supplier_registration_type =="4"?"selected":"") }} value="4">Public Limited Company</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">Supplier Type</label>
                                    <select class="form-control" id="" name="supplier_type" value="{{$suppliers->supplier_type}}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($suppliers->supplier_type =="1"?"selected":"") }} value="1">Local </option>
                                        <option {{ ($suppliers->supplier_type =="2"?"selected":"") }} value="2">Foreign</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">VAT Number</label>
                                    <input type="text" class="form-control" id="" placeholder="VAT Number" name="supplier_vat_number" value="{{$suppliers->supplier_vat_number}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">SVAT Number</label>
                                    <input type="text" class="form-control" id="" placeholder="SVAT Number" name="supplier_svat_number" value="{{$suppliers->supplier_svat_number}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Product Type</label>
                                    <input type="password" class="form-control" id="" placeholder="Product Type" name="supplier_product_type" value="{{$suppliers->supplier_product_type}}">
                                </div>
                            </div>
                            <b><p class="card-description"> Address </p><b>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="" placeholder="Address 1" name="supplier_address_line1" value="{{$suppliers->supplier_address_line1}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Address 2</label>
                                    <input type="text" class="form-control" id="" placeholder="Address 2" name="supplier_address_line2" value="{{$suppliers->supplier_address_line2}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="">Mobile Number</label>
                                    <input type="text" class="form-control" id="" placeholder="Mobile Number" name="supplier_mobile_number" value="{{$suppliers->supplier_mobile_number}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Fixed Phone Number</label>
                                    <input type="text" class="form-control" id="" placeholder="Fixed Phone Number" name="supplier_fixedphone_number" value="{{$suppliers->supplier_fixedphone_number}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">email Address</label>
                                    <input type="text" class="form-control" id="" placeholder="email Address" name="supplier_email" value="{{$suppliers->supplier_email}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Web Address</label>
                                    <input type="text" class="form-control" id="" placeholder="Web Address" name="supplier_web_address" value="{{$suppliers->supplier_web_address}}">
                                </div>
                            </div>
                            <b><p class="card-description"> Contact Person </p></b>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Contact Person Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Contact Person Name" name="supplier_contact_person_name" value="{{$suppliers->supplier_contact_person_name}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Contact Person Designation</label>
                                    <input type="text" class="form-control" id="" placeholder="Contact Person Designation" name="supplier_contact_person_designation" value="{{$suppliers->supplier_contact_person_designation}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Contact Person Mobile Number</label>
                                    <input type="text" class="form-control" id="" placeholder="Contact Person Mobile Number" name="supplier_contact_person_mobile_number" value="{{$suppliers->supplier_contact_person_mobile_number}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Contact Person email Address</label>
                                    <input type="text" class="form-control" id="" placeholder="Contact Person email Address" name="supplier_contact_person_email" value="{{$suppliers->supplier_contact_person_email}}">
                                </div>
                            </div>
                            <b><p class="card-description"> Bank Details </p></b>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Bank Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Bank Name" name="supplier_bank_name" value="{{$suppliers->supplier_bank_name}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Bank Branch</label>
                                    <input type="text" class="form-control" id="" placeholder="Bank Branch" name="supplier_bank_branch" value="{{$suppliers->supplier_bank_branch}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Bank Account Number</label>
                                    <input type="text" class="form-control" id="" placeholder="Bank Account Number" name="supplier_bank_account_number" value="{{$suppliers->supplier_bank_account_number}}">
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="">Supplier Status</label>
                                    <select class="form-control" id="" name="supplier_status" value="{{$suppliers->supplier_status}}">
                                        <option selected disabled>Select Status</option>
                                        <option {{ ($suppliers->supplier_status =="1"?"selected":"") }} value="1">Active </option>
                                        <option {{ ($suppliers->supplier_status =="1"?"selected":"") }} value="2">Inactive</option>
                                    </select>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-success me-2">Update</button>
                            <a href="{{ route('supplier.all') }}" class="btn btn-primary me-2"> Previous </a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
