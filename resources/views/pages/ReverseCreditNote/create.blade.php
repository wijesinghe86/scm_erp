@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1 style="color:grey" class="card-title">Credit Note</h1>

                    <form class="forms-sample" method="POST" action="{{ route('reverse_credit_note.store') }}">
                        @csrf
                        <br>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Invoice No</label>
                                <select class="form-control invoice-select" name="invoice_no" id="invoice_no"
                                    onchange="invoiceOnChange(this)">
                                    <option value="" selected>Select Invoice</option>
                                    @foreach ($urgent_invoices as $urgent_invoice)
                                    <option value="{{ $urgent_invoice->id }}">
                                        {{ $urgent_invoice->invoice_number }}
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
                                <label>Reverse Credit Note No</label>
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
                        </div>
                        <hr>
                        <p style="color:gray"> Select the Reference Document </p>
                        <div class="row">
                            {{-- @if (count($mrs) >0)  --}}
                            <div class="form-group col-md-2 ">
                                <label>RMRS No</label>
                                <select class="form-control invoice-select mrs_input" name="reference_no" id="mrs_no">
                                    <option value="" selected>Select</option>
                                    @foreach ($rmrs as $return)
                                    <option value="{{ $return->id }}">
                                        {{ $return->return_no }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="button" style="background-color: blue" id="resetBtn">Reset</button>
                        <input type="hidden" name="reference_type" id="reference_type" />
                        <hr>

                        <div class="return_items_table"></div>
                        <br>
                        <br>

                        <button type="submit" class="btn btn-success me-2">Complete</button>
                        <a href="{{ route('reverse_credit_note.index') }}" class="btn btn-danger">Go to Credit Note Registry</a>
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
        $('.return_items_table');
    });
    $(".mrs_input").change(function() {
        var id = $(this).val();
        console.log("MRS selected:", id);
        // disaable or hide d/o and b/o when selecting mrs no
        $('#reference_type').val('MRS')
        $(".return_items_table").load('/reverse_credit_note/getReturnItems?return_id=' + id, function() {

        });
    });
    $('#resetBtn').on('click', function() {

        $('#mrs_no').attr('disabled', false)

        clearTables()
    })



    function clearTables() {

        $(".return_items_table").empty() //clear item table


    }

    let urgent_invoices = <?php echo json_encode($urgent_invoices); ?>;

    $(document).ready(function() {
        //console.log(invoices);
        $('.invoice-select').select2({
            placeholder: "Select",
        });
    });
    //get customer details, MRS No, D/O No and B/O when selecting Invoice No
    function invoiceOnChange(elem) {

        let invoice_id = elem.value;

        if (!invoice_id) return;

        clearTables();

        $.ajax({
            url: "{{ route('reverse_credit_note.getInvoiceDetails') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                invoice_id: invoice_id
            },
            success: function(response) {

                console.log("SUCCESS:", response);

                if (response.error) {
                    alert(response.error);
                    return;
                }

                // Fill invoice + customer
                $('#invoice_date').val(response.invoice_date);
                $('#customer_code').val(response.customer.customer_code);
                $('#customer_name').val(response.customer.customer_name);
                $('#vat_no').val(response.customer.vat_no);

                // Populate MRS dropdown
                $('#mrs_no').empty().append('<option selected disabled>Select RMRS</option>');

                response.mrs.forEach(function(item) {
                    $('#mrs_no').append(
                        `<option value="${item.id}">${item.return_no}</option>`
                    );
                });
            },
            error: function(xhr) {
                console.error("AJAX ERROR:", xhr.responseText);
                alert("Something went wrong. Check console.");
            }
        });
    }
</script>

@endpush