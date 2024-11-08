@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a> Balance Order Reports</h3>
                        <br>
                        <br>
                        <h4><b>1. Datewise Balance Order Status</b></h4>
                        <form method="POST" target="_blank" action="{{ route('BalanceOrder.datewise_balance_order_report') }}" >
                            @csrf
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

$(document).ready(function() {
    $('.customer-select').select2({
    });
})

function getCustomer() {
            var customer_id = $('#customer_id').val();
            var data = {
                customer_id: customer_id
            };
            $.ajax({
                url: "{{ route('customer.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    customerData = response;
                    $('#cus_code').val(response.id);
                    return
                    }
                })
                }

</script>
@endpush
