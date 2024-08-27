@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Invoice and Delivery Order Cancellation </h4>
                        <form class="forms-sample" method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
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
                                <div class="form-group col-md-2">
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
                            </div>

                            <button type="submit" class="btn btn-success me-2">Cancel</button>
                          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts').

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

$.ajax({
                url: "{{ route('invoices_cancel.getInvoiceDetails') }}",
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

                    $('#delivery_no').find('option').remove().end()
                        $('#delivery_no').append('<option selected disabled>Select Item</option>');
                        response?.deliveryOrders?.forEach(element => {
                            $('#delivery_no').append('<option  value="' + element.id +
                                '">' + element?.delivery_order_no + '</option>');
                        })

                    }
});

}

</script>
@endpush


