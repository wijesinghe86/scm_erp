@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">View Supplier Details</h1>
                    <br>
                        <form class="forms-sample">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Supplier Code : </label>
                                    <label>{{ $suppliers->supplier_code }}</label>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Supplier Name : </label>
                                    <label>{{ $suppliers->supplier_name }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Business Registration Number : </label>
                                    <label>{{ $suppliers->business_registration_number }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Business Registration Image : </label>
                                    <label>{{ $suppliers->business_registration_image }}</label>
                                </div>
                            </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Supplier Registration Type : </label>
                                    <label>{{ $suppliers->supplier_registration_type }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Supplier Type : </label>
                                    <label>{{ $suppliers->supplier_type }}</label>
                                </div>
                            </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">VAT Number : </label>
                                    <label>{{ $suppliers->supplier_vat_number }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">SVAT Number : </label>
                                    <label>{{ $suppliers->supplier_svat_number }}</label>
                                </div>
                            </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Product Type : </label>
                                    <label>{{ $suppliers->supplier_product_type }}</label>
                                </div>
                            </div>
                            <b><p class="card-description"> Address </p><b>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Address 1 : </label>
                                    <label>{{ $suppliers->supplier_address_line1 }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Address 2 : </label>
                                    <label>{{ $suppliers->supplier_address_line2 }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Mobile Number : </label>
                                    <label>{{ $suppliers->supplier_mobile_number }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Fixed Phone Number : </label>
                                    <label>{{ $suppliers->supplier_fixedphone_number }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">email Address : </label>
                                    <label>{{ $suppliers->supplier_email }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Web Address : </label>
                                    <label>{{ $suppliers->supplier_web_address }}</label>
                                </div>
                            </div>
                            <b><p class="card-description"> Contact Person </p></b>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Contact Person Name : </label>
                                    <label>{{ $suppliers->supplier_contact_person_name }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Contact Person Designation : </label>
                                    <label>{{ $suppliers->supplier_contact_person_designation }}</label>
                                </div>
                            </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Contact Person Mobile Number : </label>
                                    <label>{{ $suppliers->supplier_contact_person_mobile_number }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Contact Person email Address : </label>
                                    <label>{{ $suppliers->supplier_contact_person_email }}</label>
                                </div>
                            </div>
                            <b><p class="card-description"> Bank Details </p></b>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Bank Name : </label>
                                    <label>{{ $suppliers->supplier_bank_name }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Bank Branch : </label>
                                    <label>{{ $suppliers->supplier_bank_branch }}</label>
                                </div>
                            </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Bank Account Number : </label>
                                    <label>{{ $suppliers->supplier_bank_account_number }}</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Supplier Status : </label>
                                    <label>{{ $suppliers->supplier_status }}</label>
                                </div>
                            </div>
                            <a href="{{ route('supplier.all') }}" class="btn btn-primary float-end mb-2"> Previous </a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
