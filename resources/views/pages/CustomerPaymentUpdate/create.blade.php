@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1 style="color:grey" class="card-title">Customer Payment Update</h1>
                       
                        <form class="forms-sample" method="POST" action="{{ route('customerpayment.store') }}">
                            @csrf
                            <br>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Payment Code</label>
                                    <input type="text" class="form-control" name="payment_code" id="payment_code"
                                        placeholder="payment_code" value="{{$next_number}}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" name="customer_code" id="customer_code"
                                        placeholder="customer_code" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Customer Name</label>
                                    <select class="form-control customer-select" name="customer" id="customer" onchange="customerOnChange(this)">
                                        <option value="" selected>Select customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">
                                                {{ $customer->customer_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Initial Credit Limit</label>
                                    <input type="text" class="form-control" name="initial_credit_limit" id="initial_credit_limit"
                                        placeholder="initial_credit_limit" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Outstanding Amount</label>
                                    <input type="text" class="form-control" name="outstanding_amount" id="outstanding_amount"
                                        placeholder="outstanding_amount" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Available Credit</label>
                                    <input type="text" class="form-control" name="available_credit" id="available_credit"
                                        placeholder="available_credit" readonly>
                                </div>
                            </div>
                            <hr>
                            <div> Payment Received Update </div>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Select Invoice</label>
                                    <select class="form-control customer-select" name="invoice_no" id="invoice_no">
                                        <option value="" selected>Select Invoice</option>
                                        @foreach ($invoices as $invoice)
                                            <option value="{{ $invoice->id }}">
                                                {{ $invoice->invoice_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control" name="reference_no" id="reference_no"
                                        placeholder="reference_no">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Received Amount (Rs.)</label>
                                    <input type="number" class="form-control" name="received_amount" id="received_amount"
                                        placeholder="received_amount">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Received Date</label>
                                    <input type="date" class="form-control" name="received_date" id="received_date"
                                        placeholder="date">
                                </div>
                            </div>
                               
                                

                            <button type="submit" class="btn btn-success me-2">Complete</button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        let customers = <?php echo json_encode($customers); ?>;
        
        $(document).ready(function() {
            //console.log(invoices);
            $('.customer-select').select2({
                placeholder: "Select",
            });
        });

function customerOnChange(elem) {

var selectedCustomer = customers.filter((row) => {
    return row.id == elem.value;
})

if (selectedCustomer.length == 0) {
    return;
}

selectedCustomer = selectedCustomer[0];
// clearTables() // clear all item tables when change the invoice number

$.ajax({
    url: "{{ route('customerpayment.getCustomerDetails') }}",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    data: {
        customer_name: selectedCustomer?.customer_name,
        customer_id: selectedCustomer?.id,
    },
    success: function(response) {
        console.log(response)

        $('#invoice_no').find('option').remove().end()
            $('#invoice_no').append('<option selected disabled>Select Invoice</option>');
            response?.invoice?.forEach(element => {
                $('#invoice_no').append('<option  value="' + element.id +
                    '">' + element?.invoice_number + '</option>');
            })

      
    }

});

document.getElementById("available_credit").value = selectedCustomer.customer_credit_limit;
document.getElementById("customer_code").value = selectedCustomer.customer_code;
document.getElementById("initial_credit_limit").value = selectedCustomer.initial_credit_limit;
}
    </script>
@endpush

