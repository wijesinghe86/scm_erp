@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Credit Note Approval Form</h4>
                        <form class="forms-sample" method="POST"
                            action="{{ route('credit_note_approval.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Credit Note No</label>
                                    <select class="form-control creditnote-select cn_input" name="credit_note_no" id="credit_note_no"
                                    onchange="CreditNoteOnChange(this)">
                                       
                                        <option value="" selected disabled>Select Credit Note</option>
                                        @foreach ($list as $creditNote)
                                        <option value="{{ $creditNote->id }}">{{ $creditNote->credit_note_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Invoice No</label>
                                    <input type = "text" class="form-control" name="invoice_no" id="invoice_no">
                                      
                                </div>
                                {{-- <div class="form-group col-md-2">
                                    <label>Customer</label>
                                    <input type = "text" class="form-control" name="customer_name" id="customer_name">
                                      
                                </div> --}}
                            </div>

                            <div class="items_table"></div>

                           


                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <a href="{{route('credit_note_approval.index')}}" class="btn btn-danger">Credit Note Approval Registry</a> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
     let creditnotes = <?php echo json_encode($list); ?>;
$(document).ready(function() {
    //console.log(invoices);
    $('.creditnote-select').select2({
        placeholder: "Select",
    });
});

function CreditNoteOnChange(elem) {
var selectedCreditNote = creditnotes.filter((row) => {
    return row.id == elem.value;
})

if (selectedCreditNote.length == 0) {
    return;
}

selectedCreditNote = selectedCreditNote[0];
// clearTables() // clear all item tables when change the invoice number

$.ajax({
    url: "{{ route('credit_note_approval.getCreditNoteDetails') }}",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    data: {
        credit_note_no: selectedCreditNote?.credit_note_no,
        creditNote_id: selectedCreditNote?.id,
    },
    success: function(response) {
         console.log(response)
        
    }
    });
document.getElementById("invoice_no").value = selectedCreditNote.invoice.invoice_number;
document.getElementById("customer_name").value = selectedCreditNote.invoice.Customer.customer_name;
}

$(document).ready(function() {
            // alert("ss");
            $('.items_table');
        });
        $(".cn_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);
        $(".items_table").load('/credit_note_Approval/getCnItems?credit_note_no=' + id, function() {

            });
        });

</script>
@endpush