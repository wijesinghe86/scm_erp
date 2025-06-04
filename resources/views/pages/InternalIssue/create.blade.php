@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Internal Material Issuance</h4>
                        <form class="forms-sample" method="POST" action="{{ route('internal_issue.store') }}">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>IID No</label>
                                    <input type="text" class="form-control" name="iid_no" placeholder="IID No"
                                        value="{{ $next_number }}" readonly >
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Issue Date</label>
                                    <input type="date" class="form-control" name="issue_date"
                                         id="issue_date" value="{{ old('issue_date') }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Issue Warehouse</label>
                                    {{-- <option value="{{$classes->id}}" {{($classes->id == old('class_id')) ? 'selected' : ''}}>{{$classes->title}}</option> --}}
                                    <select name="issue_warehouse_id" class="form-control" id="issue_warehouse_id" placeholder="Issue Warehouse">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}"{{($warehouse->id == old('issue_warehouse_id')) ? 'selected' : ''}}>{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Plant</label>
                                    <select name="plant_id" class="form-control" id="plant_id" placeholder="Plant">
                                        @foreach ($plants as $plant)
                                            <option value="{{ $plant->id }}"{{($plant->id == old('plant_id')) ? 'selected' : ''}}>
                                                {{ $plant->plant_name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>Justification</label>
                                    <input type="text" class="form-control" name="justification"
                                        value="{{ old('justification') }}" placeholder="Justification">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control" name="reference_no"
                                        value="{{ old('reference_no') }}" placeholder="Reference No">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                    <input type="text" readonly class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <select name="stock_item_id" class="form-control item-select" id="stock_item_id"
                                        onchange="itemOnChange(this) ">
                                        <option selected disabled>Select Item</option>
                                        @foreach ($stockItems as $item)
                                            <option value="{{ $item->id }}">{{ $item->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>U/M</label>
                                    <input type="text" readonly class="form-control" name="uom" id="uom"
                                        placeholder="U/M">
                                </div>

                                    <div class="form-group col-md-2">
                                    <label>Issue Qty</label>
                                    <input type="number" class="form-control" name="issue_qty" id="issue_qty"
                                        placeholder="Issue Qty" >
                                </div>
                                    <div class="form-group col-md-2">
                                    <label>Issue Weight</label>
                                    <input type="number" class="form-control" name="issue_weight" id="issue_weight"
                                        placeholder="Isssue Weight" >
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2" name="button" value="add">Add</button>
                            {{-- <button class="btn btn-danger">Cancel</button> --}}
                            {{-- devide the page and table --}}
                            <hr/>

                            <table class="table bordered">
                                <thead>
                                    <tr>
                                        <th>Stock No</th>
                                        <th>Description</th>
                                        <th>U/M</th>
                                        <th>Issue Qty</th>
                                        <th>Issue Weight</th>
                                        <th>Issued Warehouse</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (is_array($items))
                                        @foreach ($items as $index => $item)
                                            <tr>
                                                <td>{{ $item['stock_no'] }}</td>
                                                <td>{{ $item['description'] }}</td>
                                                <td>{{ $item['uom'] }}</td>
                                                <td>{{ $item['issue_qty'] }}</td>
                                               <td>{{ $item['issue_weight'] }}</td>
                                               <td>{{ $item['issue_warehouse_id'] }}</td>
                                                <td><a href="{{ route('internal_issue.delete_item', $index) }}"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <div class="row">
                            <div class="form-group col-md-3">
                                <label>Total Issued Qty</label>
                                <input type="number" class="form-control" name="tot_qty" id="tot_qty"
                                    placeholder="Total Issued Weight" value= {{collect($items)->sum('issue_qty')}} readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Total Issued Weight</label>
                                <input type="number" class="form-control" name="tot_weight" id="tot_weight"
                                    placeholder="Total Issued Weight" value= {{collect($items)->sum('issue_weight')}} readonly>
                            </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success me-2" name="button" value="complete">Submit</button>
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
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });
    </script>

    <script type="application/javascript">
    var stockItems = '{!! $stockItems->toJson()!!}';
    stockItems = JSON.parse(stockItems);
    //console.log(grnItems);

        function itemOnChange(elem) {

        var selectedItem = stockItems.filter((row)=>{
         return row.id == elem.value;
          })

          if(selectedItem.length == 0){
            return;
          }

          selectedItem = selectedItem[0];

          document.getElementById("stock_no").value = selectedItem.stock_number;
          document.getElementById("uom").value = selectedItem.unit;
          document.getElementById("unprice").value = selectedItem.cost_price;
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
