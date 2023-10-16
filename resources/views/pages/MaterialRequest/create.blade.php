@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Materials Request Form Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('material_request.store') }}">
                            @csrf
                            <br>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>MRF Date</label>
                                    <input type="date" class="form-control" name="mrf_date" value="{{ old('mrf_date') }}"
                                        placeholder="MRF date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>MRF No</label>
                                    <input type="text" class="form-control" name="mrf_no" placeholder="MRF No"
                                        value="{{ $next_number }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Required Date</label>
                                    <input type="date" class="form-control" name="required_date"
                                        value="{{ old('required_date') }}" id="required_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Justification</label>
                                    <input type="text" class="form-control" name="justification"
                                        value="{{ old('justification') }}" placeholder="Justification">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock No</label>
                                    <input type="text" readonly class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock No">
                                </div>
                                <div class="form-group col-md-6">
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
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Priority</label>
                                    <select name="priority" class="form-control">
                                        @foreach (config('scm.priorities') as $priority)
                                            <option value="{{ $priority['id'] }}">{{ $priority['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>MRF Qty</label>
                                    <input type="text" class="form-control" name="mrf_qty" id="mrf_qty"
                                        placeholder="MRF Qty">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success me-2" name="button" value="add">Add</button>
                            {{-- <button class="btn btn-danger">Cancel</button> --}}
                            {{-- devide the page and table --}}
                            <hr />

                            <table class="table bordered">
                                <thead>
                                    <tr>
                                        <th>Stock No</th>
                                        <th>Description</th>
                                        <th>U/M</th>
                                        <th>Priority</th>
                                        <th>MRF Qty</th>
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
                                                <td>{{ $item['priority'] }}</td>
                                                <td>{{ $item['mrf_qty'] }}</td>
                                                <td><a href="{{ route('material_request.delete_item', $index) }}"
                                                        class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <br>
                            <div class="form-group col-md-4">
                                <label>Requested By</label>
                                <select class="form-control emp-select" name="requested_by" value="{{ old('requested_by') }}">
                                    {{-- <option selected disabled>Select</option> --}}
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}"> {{ $employee->employee_fullname }} -
                                            {{ $employee->departmentData->department_name }}
                                            ({{ $employee->sectionData->section_name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success me-2" name="button" value="complete">Complete
                                Materials Request</button>
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
    <script>
        $(document).ready(function() {
            $('.emp-select').select2({
                placeholder: "Select",
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
