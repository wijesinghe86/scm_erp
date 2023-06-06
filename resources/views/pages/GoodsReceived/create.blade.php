@extends('layouts.app')
@section('content')
    <div class="content-wrapper"> 
        <div class="row">
          <div class="col-12 grid-margin stretch-card"> 
                <div class="card">  
                    <div class="card-body"> 
                        <h4 class="card-title">Goods Received Note Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('goodsreceived.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>GRN No</label>
                                    <input type="text" class="form-control" name="grn_number" value="{{ $next_number }}"
                                        placeholder="Goods Received Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>GRN Date</label>
                                    <input type="date" class="form-control" name="grn_date"
                                        placeholder="Goods Received Date">
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Goods Received Type</p>
                                    <input type="radio" name="type_of_received" value="Local">
                                    <label>Local</label>
                                    <input type="radio" name="type_of_received" value="Import">
                                    <label>Import</label>
                                   </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Received By</label>
                                    <select class="form-control" name="received_by" id="received_by" >
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($employees as $row)
                                            <option value="{{ $row->id }}">{{ $row->employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Received Date</label>
                                    <input type="date" class="form-control" name="received_date"
                                        placeholder="Received Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Inspected By</label>
                                    <select class="form-control" name="inspected_by" id="inspected_by" >
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($employees as $row)
                                            <option value="{{ $row->id }}">{{ $row->employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Inspected Date</label>
                                    <input type="date" class="form-control" name="inspected_date"
                                        placeholder="Inspected Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Verified By</label>
                                    <select class="form-control" name="verified_by" id="verified_by" >
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($employees as $row)
                                            <option value="{{ $row->id }}">{{ $row->employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Verified Date</label>
                                    <input type="date" class="form-control" name="verified_date"
                                        placeholder="Verified Date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Weight Per Unit</label>
                                    <input type="text" class="form-control" name="weight_per_unit"
                                        placeholder="Weight Per Unit">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Total Weight</label>
                                    <input type="text" class="form-control" name="total_weight"
                                        placeholder="Total Weight">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Volume Per Unit</label>
                                    <input type="text" class="form-control" name="volume_per_unit"
                                        placeholder="Volume Per Unit">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Total Volume</label>
                                    <input type="text" class="form-control" name="total_volume"
                                        placeholder="Total Volume">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>PO Number</label>
                                    <select class="form-control po_input" name="po_id" id="po_id" onchange="itemOnChange(this)" >
                                        <option value="" selected disabled>Select PO No</option>
                                        @foreach ($po_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->po_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Supplier Id</label>
                                    <input type="text" readonly class="form-control" name="supplier" id="supplier" >
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Supplier Name</label>
                                    <input type="text" readonly class="form-control" name="supplier_name" id="supplier_name" >
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Warehouse</label>
                                    <select class="form-control" name="warehouse" id="warehouse">
                                        <option value="" selected> Select </option>
                                        @foreach($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="items_table"></div>

                            <button type="submit" class="btn btn-success me-2">Complete Goods Received Note</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="application/javascript">
        var po_list = '{!! $po_list->toJson()!!}';
        po_list = JSON.parse(po_list);

        function itemOnChange(elem) {

          var selectedPo = po_list.filter((row)=>{
            return row.id == elem.value;
          })

          if(selectedPo.length == 0){
            return;
          }

          selectedPo = selectedPo[0];

          console.log("selected po",selectedPo);

          document.getElementById("supplier").value = selectedPo.get_supplier.id;
          document.getElementById("supplier_name").value = selectedPo.get_supplier.supplier_name;
            }
        </script>

@push('scripts')
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
        $(".po_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/goodsreceived/get-items?po_id=' + id, function() {

            });
        });

    </script>
    @endpush

{{-- @push('styles')
    <style>
        .select2-container .select-selection--single {
            height: 46px;
        }
    </style>
@endpush

 --}}
