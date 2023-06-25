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
                 <div class="form-group col-md-2">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" placeholder="Date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>RMI No</label>
                        <input type="text" class="form-control" name="rmi_no" placeholder="RMI No">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Warehouse Code</label>
                        <select class="form-control item-select" name="warehouse_code">
                            @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>JOB No</label>
                        <input type="text" class="form-control" name="job_no" placeholder="job No">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Plant</label>
                        <input type="text" class="form-control" name="plant_no" placeholder="Plant">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>RMR No</label>
                        <input type="text" class="form-control" name="rmr_no" placeholder="RMR No">
                    </div>
                    <div class="form-group col-md-10">
                        <label>Requested by</label>
                        <input type="text" class="form-control" name="req_by" placeholder="Requested by">
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
