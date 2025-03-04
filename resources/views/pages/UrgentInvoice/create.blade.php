@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Urgent Invoice</h4>
                        <form class="forms-sample" method="POST" action="{{ route('urgent_invoice.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Select D/O</label>
                                    <select class="form-control do_input" name="delivery_order_no" id="delivery_order_no" onchange="deliveryNoOnChange(this)">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($urgent_delivery as $row)
                                            <option value="{{ $row->id }}">{{ $row->delivery_order_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Invoice Date</label>
                                    <input type="date" class="form-control" name="po_date" value="{{ date('Y-m-d') }}"
                                        placeholder="PO Date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Invoice No</label>
                                    <input type="text" class="form-control" name="invoice_number"
                                        placeholder="Invoice No" readonly>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Invoice Type</label>
                                    <select  class="form-control" name="invoice_type" id="invoice_type">
                                        <option value="">Select</option>
                                        <option value="1">Non-Tax Invoice</option>
                                        <option value="2">Tax Invoice</option>
                                        <option value="3">Suspended Tax Invoice</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Category</label>
                                  <select  class="form-control" name="invoice_category" readonly id="invoice_category"
                                        required>
                                        <option value="">-</option>
                                        @foreach ($billTypes as $category)
                                            <option value="{{ $category->id }}">{{ $category->billtype_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Invoice Option</label>
                                    <select class="form-control" name="invoice_option" id="invoice_option">
                                        <option value="">Select</option>
                                       <option value="0">None</option>
                                       <option value="1">Option A</option>
                                       <option value="2">Option B</option>
                                       <option value="3">Option C</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                                {{-- <div class="form-group col-md-2">
                                    <label>Intended Delivery Date</label>
                                    <input type="date" class="form-control" name="po_delivery_date"
                                        placeholder="Purchase Order Date">
                                </div> --}}
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Customer Code</label>
                                        <input type="text" class="form-control" name="cus_code" id="cus_code"
                                            placeholder="cus_code" readonly>
                                    </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" id="customer_name"
                                        placeholder="customer_name" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Customer Vat No</label>
                                    <input type="text" class="form-control" name="cus_vat_no" id="cus_vat_no"
                                        placeholder="cus_vat_no" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Address</label>
                                    <input type="text" class="form-control" name="cus_address" id="cus_address"
                                        placeholder="cus_address" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Term</label>
                                    <select name="payment_terms" class="form-control" id="payment_terms">
                                        <option selected value="" disabled>Select Terms</option>
                                        @foreach ($customer::$PAYMENT_TERMS as $item)
                                            <option value="{{ $item['value'] }}">
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Credit Days</label>
                                    <select name="credit_days" class="form-control" id="credit_days">
                                        <option selected value="" disabled>Select</option>
                                        @foreach ($customer::$CREDIT_PERIODS as $item)
                                            <option value="{{ $item['value'] }}">
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>PO No</label>
                                    <input type="text" class="form-control" name="po_number", id="po_number">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control" name="ref_number", id="ref_number">
                                </div>

                            <div class="form-group col-md-4">
                                <label>Sales Staff Name</label>
                                <select class="form-control item-select" name="employee_id" id="employee_id"
                                    onchange="getEmployee()">
                                    <option selected disabled></option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->employee_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                                   <div class="items_table" id="items_table"></div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                   <div class="form-group col-md-2">
                                        <label>Sub Total</label>
                                        <input type="number" class="form-control" name="sub_total" id="sub_total"
                                            placeholder="sub_total" readonly>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label>Vat Rate</label>
                                        <input type="number" class="form-control" name="vat_rate" id="vat_rate"
                                            placeholder="vat_rate" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Vat Amount</label>
                                        <input type="number" class="form-control" name="vat_amount" id="vat_amount"
                                            placeholder="vat_amount" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Net Total</label>
                                        <input type="number" class="form-control" name="net_total" id="net_total"
                                            placeholder="net_total" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Total Discount</label>
                                        <input type="number" class="form-control" name="total_discount" id="total_discount"
                                            placeholder="total_discount" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Grand Total</label>
                                        <input type="number" class="form-control" name="grand_total" id="sub_total"
                                            placeholder="sub_total" readonly>
                                    </div>
                                    </div>
                                    <button type="submit" class="btn btn-success me-2">Create Invoice</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const invoiceCategories = <?php echo json_encode($billTypes); ?>;
            $(document).ready(function() {
                let invoiceType = $('#invoice_type').val();
                setinvoiceOption(invoiceType, "load");
            })
            $('#invoice_type').on('change', function() {
                let invoiceType = $(this).val();
                setinvoiceOption(invoiceType, "other");
            })

            function setinvoiceOption(invoiceType, runType) {
                if (invoiceType == 1) {
                    $('#invoice_option').val(0)
                    $("#invoice_option").find(':not(:selected)').prop('disabled', true);
                    const invoiceCategory = invoiceCategories?.find(row => ['UIN'].includes(row?.billtype_code))
                    if (invoiceCategory) {
                        $('#invoice_category').val(invoiceCategory?.id)
                        $('#invoice_category').trigger("change")
                    }
                    return
                }
                if (invoiceType == 2) {
                    $("#invoice_option").find(':not(:selected)').prop('disabled', false);
                    if (runType != "load") {
                        $('#invoice_option').val("")
                    }
                    const invoiceCategory = invoiceCategories?.find(row => ['UTI'].includes(row?.billtype_code))
                    if (invoiceCategory) {
                        $('#invoice_category').val(invoiceCategory?.id)
                        $('#invoice_category').trigger("change")
                    }
                    return
                }
                if (invoiceType == 3) {
                    $('#invoice_option').val(3)
                    $("#invoice_option").find(':not(:selected)').prop('disabled', true);
                    const invoiceCategory = invoiceCategories?.find(row => ['USVT'].includes(row?.billtype_code))
                    if (invoiceCategory) {
                        $('#invoice_category').val(invoiceCategory?.id)
                        $('#invoice_category').trigger("change")
                    }
                    return
                }
            }

            $('#invoice_category').on('change', function() {
                const invoice_category = $(this).val();
                $.ajax({
                url: "{{ route('urgent_invoice.get.number') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {invoice_category},
                success: function(invoiceNumber) {
                    $("#invoice_number").val(invoiceNumber);
                }
                 });
            })


    $(document).ready(function() {
             //alert("ss");
             $('.items_table');
        });
            $(".do_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/urgent_invoice/get-items?delivery_order_id=' + id, function() {

            });
        });

    function onInvoiceTypeChange(){
    const invoiceType = ('#invoice_type').val();
}

function calculateUnitPrice(elem) {
            var category = $('#invoice_option').val();
            console.log(category);
            if (category != "1") {
                return;
            }
            var unitPrice = parseFloat($(elem).val());
            var vatRate = 18;
            var newUnitPrice = unitPrice / ((100 + vatRate) / 100);
            $(elem).val(newUnitPrice.toFixed(2));
        }
function onValueChangeTest(){
    console.log("Test Triggered");
    syncCalculations()
}

function syncCalculations(){
    $.ajax({
                url: "{{ route('urgent_invoice.syncCalculations') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    option: $('#invoice_option').val(),
                    discount_value: "0",
                    discount_type: 'fixed'
                },
                success: function(data) {
                  console.log(data);
                  $('#sub_total').val(data?.grandTotal)
                }
                 });
}




</script>
<script type="application/javascript">
    var urgent_delivery = '{!! $urgent_delivery->toJson()!!}';
    urgent_delivery = JSON.parse(urgent_delivery);

    function deliveryNoOnChange(elem) {

      var selectedDo = urgent_delivery.filter((row)=>{
        return row.id == elem.value;
      })

      if(selectedDo.length == 0){
        return;
      }

      selectedDo = selectedDo[0];

      console.log("selected do", selectedDo);

    document.getElementById("cus_code").value = selectedDo.customer_id;
    document.getElementById("customer_name").value = selectedDo.get_customer.customer_name;
    document.getElementById("cus_address").value = selectedDo.get_customer.customer_address_line1;
    document.getElementById("cus_vat_no").value = selectedDo.get_customer.customer_vat_number;

    }

    </script>
@endpush
