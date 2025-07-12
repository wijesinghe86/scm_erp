@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Purchase Order through PRF Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('purchase_order_mr.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Purchase Reference Number</label>
                                    <select class="form-control item-select  prf_input" name="prf_id">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($mrfprf_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->mrfprf_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>PO Date</label>
                                    <input type="date" class="form-control" name="po_date"
                                        placeholder="PO Date">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Supplier Name</label>
                                    <select class="form-control sup-select" name="supplier_id" placeholder="Select Supplier" >
                                        <option selected disabled>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="form-group col-md-4">
                                    <label>Ship To:</label>
                                    <select class="form-control item-select" name="customer_id">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group col-md-3">
                                    <label>PO Type</label>
                                    <SELECT name="po_type" class="form-control">
                                        <option value=""> Select </option>
                                        <option value="1">Local</option>
                                        <option value="2">Import</option>
                                    </SELECT>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Weight Per Unit</label>
                                    <input type="number" class="form-control" name="weight_per_unit"
                                        placeholder="Weight Per Unit">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Volume Per Unit</label>
                                    <input type="number" class="form-control" name="volume_per_unit"
                                        placeholder="Volume Per Unit">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Total Weight</label>
                                    <input type="number" class="form-control" name="total_weight"
                                        placeholder="Total Weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Total Volume</label>
                                    <input type="number" class="form-control" name="total_volume"
                                        placeholder="Total Volume">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>PO NO</label>
                                    <input type="text" class="form-control" name="po_number" value="{{ $next_number }}"
                                        placeholder="PO No" value="" readonly>
                                </div>
                            </div>
                                    <div class="items_table"></div>
                                    <br>
                                   <div class="form-group col-md-3">
                                        <label>Total PO Value</label>
                                        <input type="number" class="form-control" name="po_value" id="po_value" value="0"
                                            placeholder="PO Value" readonly>

                                    </div>
                                    <button type="submit" class="btn btn-success me-2">Complete Purchase Order</button>
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
        $('.sup-select').select2({
            placeholder: "Select",
        });
    });

        $(document).ready(function() {
            // alert("ss");
            // $('.items_table');
        });
        $(".prf_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/purchase_order_mr/get-items?prf_id=' + id, function() {

            });
        });




        //         $( "#result" ).load( "ajax/test.html", function() {
        //   alert( "Load was performed." );
        // });

    function onChangeQty(e,index){
    const qty = e.value;
    const price = $(`#price-${index}`).val();
    const remainingQty = $(`#remaining_qty-${index}`).val();
    if  (parseInt(qty) > parseInt(remainingQty))
    {

        $(`#qty-${index}`).val(remainingQty);
        alert('Quantity cannot be greater than remaining qty');
        return
    }
    console.log({qty});
    console.log({price});
    $(`#total-${index}`).val(qty*price);
    // const poValue = $(`#po_value`).val()
    // $(`#po_value`).val(poValue=poValue+(qty*price));
    }


    function onChangePrice(e,index){
    const qty = $(`#qty-${index}`).val();
    const price = e.value;
    console.log({qty});
    console.log({price});
    $(`#total-${index}`).val(qty*price);
    // const poValue = $(`#po_value`).val()
    // $(`#po_value`).val(poValue=poValue+(qty*price));
    }

    function povalue(index){
        var tot = 0;
            tot = tot +  $(`#total-${index}`).val();
            $('#po_value').val(tot);

    }


    </script>
@endpush

