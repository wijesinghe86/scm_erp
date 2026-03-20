@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Organization Creation Master</h4>
            <form class="forms-sample" method="POST" action="{{ route('organization.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Organization Code *</label>
                        <input type="text" class="form-control" name="organization_code" placeholder="organization_code">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Organization Name *</label>
                        <input type="text" class="form-control" name="organization_name" placeholder="organization_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>TIN No *</label>
                        <input type="text" class="form-control" name="organization_tin_no" placeholder="tin_no">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Address 1 *</label>
                        <input type="text" class="form-control" name="organization_address_line1" placeholder="Address1">
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Address 2 *</label>
                        <input type="text" class="form-control" name="organization_address_line2" placeholder="Address2">
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>E mail *</label>
                        <input type="email" class="form-control" name="organization_email" placeholder="email">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Telephone No *</label>
                        <input type="text" class="form-control" name="organization_phone_number" placeholder="telephone_no">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Whatsapp No *</label>
                        <input type="text" class="form-control" name="organization_whatsapp_number" placeholder="whatsapp_no">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" name="organization_contact_person_name" placeholder="contact_person">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Contact Person Phone Number</label>
                        <input type="text" class="form-control" name="organization_contact_person_phone" placeholder="contact_person_phone">
                    </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="remarks" placeholder="Remarks">
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
