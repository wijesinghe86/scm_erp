@extends('layouts.app')
@section('content')
    {{-- <div class="content-wrapper"> --}}
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Semi Production Process</h4>
                        <h4 class="card-title"> Raw Material Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('semiproduction.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Semi_Pro No</label>
                                    <input type="text" class="form-control" name="semi_product_no" value="{{ $next_number }}"
                                        placeholder="Semi Product No">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="product_date"value="{{ old('product_date') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Plant</label>
                                    <select class="form-control item-select" name="plant">
                                        <option selected disabled>Select Plant</option>
                                        @foreach ($plants as $plant)
                                            <option value="{{ ($plant->id )}}" @if(old('plant') == $plant->id)selected @endif>{{ $plant->plant_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse</label>
                                    <select class="form-control item-select" name="warehouse">
                                        <option selected disabled>Select</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" @if(old('warehouse')== $warehouse->id)selected @endif>{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Raw Material</label>
                                    <select name="stock_item_id" id="stock_item_id" class="form-control item-select" onchange="grnitemOnChange(this)" >
                                        <option selected disabled>Select Item</option>
                                        @foreach($grnItems as $grnItem)
                                          <option value="{{ $grnItem->id}}" @if(old('grnItem')== $grnItem->id) selected @endif>{{ $grnItem->description}}</option>
                                          @endforeach
                                      </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Stock No</label>
                                  <input type="text" readonly class="form-control" name="stock_no" id="stock_no" placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>U/M</label>
                                  <input type="text" readonly class="form-control" name="uom" id="uom" placeholder="U/M">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title"> Semi Production</h4>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Raw_Mat Serial No</label>
                                    <div class="serial_picker"></div>

                                </div>
                                <div class="form-group col-md-2">
                                    <label>Qty</label>
                                    <input type="text" class="form-control" name="qty" placeholder="Qty" id="qty">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Actual Weight</label>
                                    <input type="text" class="form-control" name="actual_weight" id="actual_weight"
                                        placeholder="actual_weight">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>GRN No</label>
                                    <input type="text" class="form-control" name="grn_no" id="grn_no"
                                        placeholder="GRN No">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <select name="semi_stock_item_id" class="form-control item-select" id="semi_stock_item_id" onchange="itemOnChange(this) ">
                                      <option selected disabled>Select Item</option>
                                      @foreach($stockItems as $item)
                                        <option value="{{ $item->id}}"> {{ $item->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                  <input type="text" readonly class="form-control" name="stockNo" id="stockNo" placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>U/M</label>
                                  <input type="text" readonly class="form-control" name="uom" id="unit" placeholder="U/M">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Semi Product Qty</label>
                                    <input type="text" class="form-control" name="semi_qty" id="semi_qty" placeholder="Semi Qty">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Semi Product Weight</label>
                                    <input type="text" class="form-control" name="semi_weight" id="semi_weight"
                                        placeholder="Semi Product Weight">
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label>Semi Product Serial No</label>
                                    <input type="text" class="form-control" name="semi_serial_no" id="semi_serial_no"
                                        placeholder="Semi Serial No">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2" name="button" value="add">Add</button>
                            <div class="row">
                                <table class="table bordered">
                                    <thead>
                                        <tr>
                                            <th>Raw S/N</th>
                                            <th>Raw Des</th>
                                            <th>Raw Serial No</th>
                                            <th>Semi Pro S/N</th>
                                            <th>Semi Pro Des</th>
                                            <th>Semi Pro Qty </th>
                                            <th>Semi Pro Weight</th>
                                            <th>Semi Serial No</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(is_array($items))
                                        @foreach($items as $index => $item)
                                        <tr>
                                            <td>{{ $item['stock_no'] }}</td>
                                            <td>{{ $item['raw_description'] }}</td>
                                            <td>{{ $item[('serial')] }}</td>
                                            <td>{{ $item['stockNo'] }}</td>
                                            <td>{{ $item['semi_description'] }}</td>
                                            <td>{{ $item['semi_qty'] }}</td>
                                            <td>{{$item['semi_weight']}}</td>
                                            <td>{{ $item['semi_serial_no'] }}</td>
                                            <td><a href="{{route('semiproduction.delete_item',$index)}}" class="btn btn-danger">Delete</a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Semi Product Qty</label>
                                    <input type="text" class="form-control" name="tot_semi_product" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Raw Material Qty</label>
                                    <input type="text" class="form-control" name="tot_raw_material" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remaining Qty</label>
                                    <input type="text" class="form-control" name="remaining_qty" readonly>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Complete Semi Production</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.item-select').select2({
        placeholder: "Select Item",
    });
});

</script>

<script type="application/javascript">


    function grnitemOnChange(elem) {
        var grnItems = '{!! $grnItems->toJson()!!}';
    grnItems = JSON.parse(grnItems);
        // console.log(grnItems);

      var selectedItem = grnItems.filter((row)=>{
        return row.id == elem.value;
      })

      if(selectedItem.length == 0){
        return;
      }

      selectedItem = selectedItem[0];

      document.getElementById("stock_no").value = selectedItem.stock_number;
      document.getElementById("uom").value = selectedItem.unit;

      loadSerials( elem.value);

    }
</script>

    <script type="application/javascript">
    var stockItems = '{!! $stockItems->toJson()!!}';
    stockItems = JSON.parse(stockItems);

    function itemOnChange(elem) {

      var selectedItem = stockItems.filter((row)=>{
        return row.id == elem.value;
      })

      if(selectedItem.length == 0){
        return;
      }

      selectedItem = selectedItem[0];

      document.getElementById("stockNo").value = selectedItem.stock_number;
      document.getElementById("unit").value = selectedItem.unit;

    }
    </script>

   //
   <script>
   function loadSerials(item_id) {

            $(".serial_picker").load('/SemiProduction/loadSerial?item_id=' + item_id, function() {
                registerListners();
            });
        }

    function registerListners  () {
        $(".serial_picker select").change(function() {
            console.log("codes",$(this).val())

            var items = JSON.parse(window.codes);
        // console.log(grnItems);

      var selectedItem = items.filter((row)=>{
        return row.id == $(this).val();
      })

      if(selectedItem.length == 0){
        return;
      }

      selectedItem = selectedItem[0];

      document.getElementById("grn_no").value = selectedItem.grn.grn_no;
      document.getElementById("qty").value = selectedItem.qty;

        })
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
