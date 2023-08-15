@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Openning Balance Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('obentry.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    <input value="{{ date('Y-m-d') }}" type="date" class="form-control"
                                        name="ob_date" id="ob_date" placeholder="date">
                                </div>
                                <div class="form-group col-md-4">
                                <label>Reference No</label>
                                <input value="{{$ref_number }}" type="text" class="form-control" name="ref_no" id="ref_no"
                                placeholder="Ref_No" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse</label>
                                    <select class="form-control warehouse-select" name="warehouse" id="warehouse">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Justification</label>
                                    <input value="{{ $justifications}}" type="text" class="form-control" name="justification" id="justification"
                                        placeholder="Justification" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Stock Number</label>
                                    <input readonly type="text" class="form-control" name="stock_number" id="stock_number">
                                    @if($errors->has('stock_number'))
                                        <div class="error">{{ $errors->first('stock_number') }}</div>
                                        @endif
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Description</label>
                                    <select style="width: 100%;" class="form-control item-select" name="stock_id" id="stock_id" onchange="itemOnChange(this)">
                                        <option value="">Select Item</option>
                                        @foreach ($stock_items as $stock_item)
                                            <option value="{{ $stock_item->id }}">{{ $stock_item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Unit</label>
                                    <input readonly type="text" class="form-control" name="stock_unit" id="stock_unit">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Current Stock Balance</label>
                                    <input readonly type="text" class="form-control" id="current_stock_bal">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Quantity</label>
                                    <input readonly onkeyup="onQuantityChange(this)" type="number" class="form-control" name="qty" id="qty"
                                        placeholder="Quantity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>New Stock Balance</label>
                                    <input readonly type="text" class="form-control" id="new_stock_bal">
                                </div>
                            </div>
                            {{-- <button name="addAnother" value="0" type="submit" class="btn btn-success me-2">Create</button> --}}
                            <button name="addAnother" value="1" type="submit" class="btn btn-success me-2">Create And Add another</button>
                            <a href="{{ route('obentry.index') }}" class="btn btn-primary me-2"> View Report </a>
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
            // viewItemTable()
            $('.item-select').select2({
                placeholder: "Select Item",
            });
        });
        </script>

<script>
    $(document).ready(function() {
        // viewItemTable()
        $('.warehouse-select').select2({
            placeholder: "Select Warehouse",
        });

        let warehouse = '{{ $warehouse_name }}'
        if (warehouse == null) {
            warehouse = ""
        }

        $('.warehouse-select').val(warehouse).trigger('change')

    });
</script>


        <script type="application/javascript">
     var stock_items = '{!! $stock_items->toJson()!!}';
        stock_items = JSON.parse(stock_items);


        function itemOnChange(elem) {


            const selectedItem = stock_items?.find(row => row?.id == elem.value)

          if(!selectedItem){
            return;
          }

          const warehouse= $('#warehouse').val();


          $.ajax({
                url: "{{ route('obentry.stock') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    stock_item_id:selectedItem?.id,
                    warehouse,
                },
                success: function(response) {
                    $('#current_stock_bal').val(response.qty);
                    $('#qty').prop('readonly',false);
                },
                error: function(data) {
                    $.each(data.responseJSON?.errors, function(key, value) {
                        alertDanger(value);
                    });
                }
            });


          document.getElementById("stock_number").value = selectedItem.stock_number;
          document.getElementById("stock_unit").value = selectedItem.unit;

        }

        function onQuantityChange(event) {
            let value = event.value;

            if(value <= 0){
                let newQuantity = value.slice(1)
                event.value= newQuantity;
                value=newQuantity
            }

            if(value ==""){
                value = 0
            }


           let curretnValue =  $('#current_stock_bal').val()

           if(curretnValue == undefined ||  curretnValue == ""){
                curretnValue = 0;
           }

           let newValue =parseFloat(curretnValue) + parseFloat(value)

           $('#new_stock_bal').val(newValue)
        }
        </script>
        @endpush




