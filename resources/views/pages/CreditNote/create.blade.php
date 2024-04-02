@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1 style="color:grey" class="card-title">Credit Note</h1>
                       
                        <form class="forms-sample" method="POST" action="{{ route('credit_note.store') }}">
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
                                <div class="form-group col-md-3">
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
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" name="customer_code" id="customer_code"
                                        placeholder="invoice_no" readonly>
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
                            </div>
                            <hr>
                            <p style="color:gray"> Select the Reference Document </p>
                            <div class="row">
                                 {{-- @if (count($mrs) >0)  --}}
                                <div class="form-group col-md-2 ">
                                    <label>MRS No</label>
                                    <select class="form-control invoice-select mrs_input" name="reference_no" id="mrs_no">
                                        <option value="" selected>Select</option>
                                        @foreach ($mrs as $return)
                                            <option value="{{ $return->id }}">
                                                {{ $return->return_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>    
                                {{-- @endif  --}}
                                
                                 {{-- @if (count($deliveryOrders) >0)  --}}
                                <div class="form-group col-md-2 ">
                                    <label>D/O No</label>
                                    <select class="form-control invoice-select do_input" name="reference_no" id="delivery_no">
                                        <option value="" selected>Select</option>
                                        @foreach ($deliveryOrders as $delivery)
                                            <option value="{{ $delivery->id }}">
                                                {{ $delivery->delivery_order_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                              {{-- @endif  --}}
                                
                             {{-- @if (count($balanceOrders) >0)  --}}
                                <div class="form-group col-md-2 ">
                                   <label>B/O No</label>
                                    <select class="form-control invoice-select bo_input" name="reference_no" id="bal_no">
                                        <option value="" selected>Select</option>
                                        @foreach ($balanceOrders as $balances)
                                            <option value="{{ $balances->id }}">
                                                {{ $balances->balance_order_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- @endif --}}
                                </div>
                                <button type="button" style="background-color: blue"  id="resetBtn" >Reset</button>
                                <input type="hidden" name="reference_type" id="reference_type" />
                                <hr>
                            <div class="items_table"></div>
                            <div class="return_items_table" ></div>
                            <div class="balance_items_table" ></div>
                            <br>
                            <br>

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
        $(document).ready(function() {
            // alert("ss");
            $('.items_table');
        });
        $(".do_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);
        $('#mrs_no').attr('disabled', true)
        $('#bal_no').attr('disabled', true)
        $('#reference_type').val('DO')

            $(".items_table").load('/credit_note/getNonIssues?delivery_order_no=' + id, function() {

            });
        });

        $(document).ready(function() {
            // alert("ss");
            $('.return_items_table');
        });
        $(".mrs_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);
            // disaable or hide d/o and b/o when selecting mrs no
            $('#delivery_no').attr('disabled', true)
            $('#bal_no').attr('disabled', true)
            $('#reference_type').val('MRS')
            $(".return_items_table").load('/credit_note/getReturnItems?return_id=' + id, function() {
        
            });
        });
    $('#resetBtn').on('click', function(){
        $('#delivery_no').attr('disabled', false)
        $('#mrs_no').attr('disabled', false)
        $('#bal_no').attr('disabled', false)
        clearTables()
    })


    function clearTables(){
        $(".items_table").empty() //clear item table
        $(".return_items_table").empty() //clear item table
        $(".balance_items_table").empty() //clear item table

    }

        $(document).ready(function() {
            // alert("ss");
            $('.balance_items_table');
        });
        $(".bo_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);
            $('#mrs_no').attr('disabled', true)
            $('#delivery_no').attr('disabled', true)
            $('#reference_type').val('BO')
            $(".balance_items_table").load('/credit_note/getBalanceOrders?balance_order_id=' + id, function() {

            });
        });
        let invoices = <?php echo json_encode($invoices); ?>;

        $(document).ready(function() {
            //console.log(invoices);
            $('.invoice-select').select2({
                placeholder: "Select",
            });
        });
//get customer detals, MRS No, D/O No and B/O when selecting Invoice No
        function invoiceOnChange(elem) {

            var selectedInvoice = invoices.filter((row) => {
                return row.id == elem.value;
            })

            if (selectedInvoice.length == 0) {
                return;
            }

            selectedInvoice = selectedInvoice[0];
            clearTables() // clear all item tables when change the invoice number
            
            $.ajax({
                url: "{{ route('creditnote.getInvoiceDetails') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    invoice_number: selectedInvoice?.invoice_number,
                    invoice_id: selectedInvoice?.id,
                },
                success: function(response) {
                    console.log(response)

                    $('#mrs_no').find('option').remove().end()
                        $('#mrs_no').append('<option selected disabled>Select Item</option>');
                        response?.mrs?.forEach(element => {
                            $('#mrs_no').append('<option  value="' + element.id +
                                '">' + element?.return_no + '</option>');
                        })

                        $('#delivery_no').find('option').remove().end()
                        $('#delivery_no').append('<option selected disabled>Select Item</option>');
                        response?.deliveryOrders?.forEach(element => {
                            $('#delivery_no').append('<option  value="' + element.id +
                                '">' + element?.delivery_order_no + '</option>');
                        })

                        $('#bal_no').find('option').remove().end()
                        $('#bal_no').append('<option selected disabled>Select Item</option>');
                        response?.balanceOrders?.forEach(element => {
                            $('#bal_no').append('<option  value="' + element.id +
                                '">' + element?.balance_order_no + '</option>');
                        })
                }

            });

            document.getElementById("invoice_date").value = selectedInvoice.invoice_date;
            document.getElementById("customer_code").value = selectedInvoice.customer.customer_code;
            document.getElementById("customer_name").value = selectedInvoice.customer.customer_name;
            document.getElementById("vat_no").value = selectedInvoice.customer.customer_vat_number;
            document.getElementById("invOption").value = selectedInvoice.customer.customer_vat_number;
        }

        


    </script>
@endpush

