@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Raw Material Issue For Production</h4>
            <form class="forms-sample" method="POST" action="{{ route('rawmaterialissueforproduction.store') }}">
              @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Issue Document Number</label>
                        <input type="text" class="form-control" name="issue_document_number" placeholder="Issue Document Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Warehouse Code</label>
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Plant Number</label>
                        <input type="text" class="form-control" name="plant_number" placeholder="Plant Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Job Order Number</label>
                        <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>PPS Number</label>
                        <input type="text" class="form-control" name="pps_number" placeholder="PPS Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Stock Number</label>
                        <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Semi Product Number</label>
                        <input type="text" class="form-control" name="semi_product_number" placeholder="Semi Product Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Serial Number</label>
                        <input type="text" class="form-control" name="serial_number" placeholder="Serial Number">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Issue Quantity By Serial</label>
                        <input type="text" class="form-control" name="issue_quantity_by_serial" placeholder="Issue Quantity By Serial">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issued Weight By Serial</label>
                        <input type="text" class="form-control" name="issued_weight_by_serial" placeholder="Issued Weight By Serial">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Issue Quantity</label>
                        <input type="text" class="form-control" name="total_issue_quantity" placeholder="Total Issue Quantity">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Total Weight</label>
                        <input type="text" class="form-control" name="total_weight" placeholder="Total Weight">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issued By</label>
                        <input type="text" class="form-control" name="issued_by" placeholder="Issued By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issued Date</label>
                        <input type="date" class="form-control" name="issued_date" placeholder="Issued Date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Approved By</label>
                        <input type="text" class="form-control" name="approved_by" placeholder="Approved By">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Approved Date</label>
                        <input type="date" class="form-control" name="approved_date" placeholder="Approved Date">
                    </div>
                </div>


                <button type="submit" class="btn btn-success me-2">Submit</button>
                <button class="btn btn-danger">Cancel</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection

  @push('scripts')
<script>
    $(document).ready(function(){
        $('.item-select').select2(
            {
                placeholder: "Select Item",
            });
    });

</script>
@endpush

@push('styles')
<style>
    .select2-container .select-selection--single{
        height: 46px;
    }
    </style>

@endpush
