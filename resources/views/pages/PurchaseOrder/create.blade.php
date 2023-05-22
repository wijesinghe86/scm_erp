@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Purchase Order Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('purchase_order.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>PO NO</label>
                                    <input type="text" class="form-control" name="po_number"
                                        placeholder="Purchase Order Number" value="{{ $next_number }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Purchase Order Date</label>
                                    <input type="date" class="form-control" name="po_date"
                                        placeholder="Purchase Order Date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Intended Delivery Date</label>
                                    <input type="date" class="form-control" name="po_delivery_date"
                                        placeholder="Purchase Order Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Supplier Name</label>
                                    <select class="form-control item-select" name="supplier_id">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Ship To:</label>
                                    <select class="form-control item-select" name="customer_id">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>PO Type</label>
                                    <SELECT name="po_type" class="form-control">
                                        <option value=""> Select </option>
                                        <option value="1">Local</option>
                                        <option value="2">Import</option>
                                    </SELECT>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Weight Per Unit</label>
                                    <input type="number" class="form-control" name="weight_per_unit"
                                        placeholder="Weight Per Unit">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Volume Per Unit</label>
                                    <input type="number" class="form-control" name="volume_per_unit"
                                        placeholder="Volume Per Unit">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Total Weight</label>
                                    <input type="number" class="form-control" name="total_weight"
                                        placeholder="Total Weight">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Total Volume</label>
                                    <input type="number" class="form-control" name="total_volume"
                                        placeholder="Total Volume">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Purchase Reference Number</label>
                                    <select class="form-control item-select pr_input" name="pr_id">
                                        <option value="" selected disabled>Select PRF No</option>
                                        @foreach ($pr_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->prf_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                    <div class="items_table"></div>
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
            // alert("ss");
            // $('.items_table');
        });
        $(".pr_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/purchase_order/get-items?pr_id=' + id, function() {

            });
        });



        //         $( "#result" ).load( "ajax/test.html", function() {
        //   alert( "Load was performed." );
        // });
    </script>
@endpush
