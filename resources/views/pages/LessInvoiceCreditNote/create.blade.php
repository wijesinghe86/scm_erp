@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1 style="color:grey" class="card-title">Credit Note</h1>
                       
                        <form class="forms-sample" method="POST" action="{{ route('less_credit_note.store')}}">
                            @csrf
                            <br>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Invoice No</label>
                                    <select class="form-control invoice-select" name="invoice_no" id="invoice_no"
                                        onchange="invoiceOnChange(this)">
                                        <option value="" selected>Select Invoice</option>
                                        @foreach ($invoices as $invoice)
                                            <option value="{{ $invoice->id }}">
                                                {{ $invoice->invoice_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Invoice Date</label>
                                    <input type="date" class="form-control" name="invoice_date" id="invoice_date"
                                        placeholder="invoice_date" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Credit Note No</label>
                                    <input type="text" class="form-control" name="credit_note_no"
                                        placeholder="credit_note_no" value="{{$next_number}}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Credit Note Date</label>
                                    <input type="date" class="form-control" name="credit_note_date" placeholder="Credit_Note_Date"
                                        value="{{ now()->format('Y-m-d') }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Hand Chit Date</label>
                                    <input type="date" class="form-control" name="hand_chit_date"
                                        placeholder="hand_chit_date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Less Invoice No</label>
                                    <input type="text" class="form-control" name="less_invoice_no"
                                        placeholder="less_invoice_no">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Less Amount</label>
                                    <input type="decimal" class="form-control" name="less_amount" id="less_amount"
                                        placeholder="less_amount">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Invoice Amount</label>
                                    <input type="decimal" class="form-control" name="invoice_amount" id="invoice_amount"
                                        placeholder="invoice_amount" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Less Invoice Amount</label>
                                    <input type="decimal" class="form-control" name="less_invoice_amount" id="less_invoice_amount"
                                        placeholder="less_invoice_amount">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" name="customer_code" id="customer_code"
                                        placeholder="customer_code" readonly>
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" id="customer_name"
                                        placeholder="customer_name" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Vat No</label>
                                    <input type="text" class="form-control" name="vat_no" id="vat_no"
                                        placeholder="vat_no" readonly>
                                </div>
                                <!-- <div class="form-group col-md-3">
                                    <label>Invoice Amount</label>
                                    <input type="text" class="form-control" name="invoice_amount" id="invoice_amount"
                                        placeholder="invoice_amount" readonly>
                                </div> -->
                            </div>                           

                            <button type="submit" class="btn btn-success me-2">Complete</button>
                            <a href="{{ route('credit_note.index') }}" class="btn btn-danger">Go to Credit Note Registry</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        let invoices = <?php echo json_encode($invoices); ?>;

        $(document).ready(function() {
            //console.log(invoices);
            $('.invoice-select').select2({
                placeholder: "Select",
            });
        });

        function invoiceOnChange(elem) {

            var selectedInvoice = invoices.filter((row) => {
                return row.id == elem.value;
            })

            if (selectedInvoice.length == 0) {
                return;
            }

            selectedInvoice = selectedInvoice[0];
           

            document.getElementById("invoice_date").value = selectedInvoice.invoice_date;
            document.getElementById("customer_code").value = selectedInvoice.customer.customer_code;
            document.getElementById("customer_name").value = selectedInvoice.customer.customer_name;
            document.getElementById("invoice_amount").value = selectedInvoice.grand_total;
            document.getElementById("vat_no").value = selectedInvoice.customer.customer_vat_number;

        }

            $('#less_amount').on('input', function() {

            let amount = $(this).val();
            let invamount = $('#invoice_amount').val();

            let newinv = parseFloat(invamount) - parseFloat(amount) 
            $('#less_invoice_amount').val(newinv)

}) 


    </script>
@endpush

