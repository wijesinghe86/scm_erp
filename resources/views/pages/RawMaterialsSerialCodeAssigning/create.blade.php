@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Materials Serial Code Assigning</h4>
                        <form class="forms-sample" method="POST"
                            action="{{ route('rawmaterialsserialcodeassigning.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    <input type="date" class="form-control" id="dateInput" name="entry_date"
                                        placeholder="entry_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse</label>
                                    <select class="form-control" name="warehouse" id="warehouse">
                                        <option selected disabled>Select</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>GRN NO</label>
                                    <select class="form-control grn_input" name="grn_id" id="grn_id">
                                        <option value="" selected disabled>Select GRN No</option>
                                        @foreach ($grn_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->grn_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="items_table"></div>


                        </form>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="code_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Raw Material Codes</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form class="forms-sample ajax-form" method="POST"
                                    action="{{ route('raw_material_code_assign.store') }}">

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Stock No</label>
                                            <input type="text" class="form-control" readonly id="form_stock_no">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Serial Code</label>
                                            <input type="text" class="form-control ajax-form-input" name="serial_no">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Supplier Code</label>
                                            <input type="text" class="form-control ajax-form-input" name="supplier_code">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Qty</label>
                                            <input type="number" class="form-control ajax-form-input" name="qty">
                                        </div>

                                        <input type="hidden" id="grn_item_id" name="grn_item_id" />
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Create</button>
                                </form>
                                <div class="row">
                                    <div class="load_serial_codes">Loading..</div>
                                </div>


                                {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}

                            </div>
                        </div>
                    </div> <!-- end modal -->

                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            let date = "";
            let warehouse = ""
            $("#dateInput").change(function() {
                var value = $(this).val();
                console.log(value);
            });
            $("#warehouse").change(function() {
                var value = $(this).val();
                console.log(value);
            });

            // goodsreceived.getGrnList
        </script>

        <script>
            $(document).ready(function() {
                $('.item-select').select2({
                    placeholder: "Select Item",
                });
            });
            $(document).ready(function() {
                // alert("ss");
                $('.items_table');
            });
            $(".grn_input").change(function() {
                var id = $(this).val();
                // alert("Handler for .change() called." + id);

                $(".items_table").load('/rawmaterialsserialcodeassigning/get-items?grn_id=' + id, function() {
                    $(".tableModal").modal()
                });
            });

            function loadSerialCodesTable(grn_item_id) {
                $(".load_serial_codes").load('/raw-material-code-assign?grn_item_id=' + grn_item_id, function() {

                });
            }

            function onClickAssigncode(grn_item_id, stock_no) {
                //alert("stock_no "+stock_no);
                // alert("code");
                $(".ajax-form-input").val("");
                $("#code_modal").modal("show");

                $("#form_stock_no").val(stock_no);
                $("#grn_item_id").val(grn_item_id);

                loadSerialCodesTable(grn_item_id);
            }

            $(".ajax-form").on('submit', function(e) {
                e.preventDefault();
                // alert("sss")

                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: $('form').serialize(),
                    success: function(response) {
                        //$('form')[0].reset();
                        // $("#feedback").text(response);
                        //alert("success")
                        var grn_item_id = $("#grn_item_id").val();
                        loadSerialCodesTable(grn_item_id);
                        $(".ajax-form-input").val("");
                    }
                });
            });

            function onDeleteSerialCode(id) {
                var result = confirm("Want to delete?");
                if (!result) {
                    return false;
                }
                var url = "{{ route('raw_material_code_assign.delete') }}";

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var grn_item_id = $("#grn_item_id").val();
                        loadSerialCodesTable(grn_item_id);
                    }
                });
            }
        </script>
    @endpush

    @push('styles')
        <style>
            .select2-container .select-selection--single {
                height: 46px;
            }
        </style>
    @endpush
