@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a> SLC Reports</h3>
                        <br>
                        <br>
                        <h4><b>1. Datewise Stock Location Change Status</b></h4>
                        <form method="POST" target="_blank" action="{{ route('StockLoctionChange.datewise_slc_report') }}" >
                            @csrf
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Warehouse</label>
                                    <select class="form-control item-select" id="warehouse_name" name="warehouse_name" required>
                                        <potion select disabled>Select Warehouse</potion>
                                        @foreach ($warehouse_lists as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" name="frm_date" id="frm_date"
                                        placeholder="frm_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" name="to_date" id="to_date"
                                        placeholder="to_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-success me-2" style="position: center"> View and Print</button>
                                </div>
                            </div>
                            {{-- <h4><b>2.Date-wise Return Status</b></h4>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" name="frm_date" id="frm_date"
                                        placeholder="frm_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" name="to_date" id="to_date"
                                        placeholder="to_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-success me-2" style="position: center"> View and Print</button>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>

$(document).ready(function() {
    $('.item-select').select2({
    });
})

</script>
@endpush
