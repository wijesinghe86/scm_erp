@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Purchase Request</h4>
                    <form class="forms-sample" method="POST" action="{{ route('purchase_request.store') }}">
                    @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>PRF Date</label>
                          <input type="date" class="form-control" name="prf_date" placeholder="PRF date">
                        </div>
                        <div class="form-group col-md-6">
                          <label>PRF No</label>
                          <input type="text" class="form-control" name="prf_no" placeholder="PRF No" value="{{$next_number}}">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label> Requested By</label>
                          <select name="requested_by" class="form-control">
                            @foreach ($employees as $employe)
                            <option value="{{$employe->id}}"> {{$employe->employee_fullname}}  ({{$employe->departmentData->department_name}} / {{$employe->sectionData->section_name}})</option>
                            @endforeach

                          </select>
                        </div>
                      </div>

                      <hr />

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Stock No</label>
                          <input type="text" readonly class="form-control" name="stock_no" id="stock_no" placeholder="Stock No">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Description</label>
                          <select name="stock_item_id" class="form-control" onchange="itemOnChange(this)">
                            <option selected disabled>Select Item</option>
                            @foreach($stockItems as $item)
                              <option value="{{ $item->id}}">{{ $item->description}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label>U/M</label>
                          <input type="text" readonly class="form-control" name="uom" id="uom" placeholder="U/M">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label>Priority</label>

                          <select name="priority" class="form-control">
                            @foreach(config('scm.priorities') as $priority)
                              <option value="{{ $priority['id']}}">{{ $priority['name']}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label>PRF Qty</label>
                          <input type="text" class="form-control" name="prf_qty" placeholder="PRF Qty">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success me-2" name="button" value="add">ADD</button>
                      {{-- <button class="btn btn-danger">Cancel</button> --}}

                      <hr />

                    <table class="table bordered">
                      <thead>
                        <tr>
                          <th>Stock No</th>
                          <th>Description</th>
                          <th>U/M</th>
                          <th>Priority</th>
                          <th>PRF Qty</th>
                          <th></th>
                      </tr>
                      </thead>
                      <tbody>
                        @if(is_array($items))
                        @foreach($items as $index => $item)
                        <tr>
                          <td>{{$item['stock_no']}}</td>
                          <td>{{$item['description']}}</td>
                          <td>{{$item['uom']}}</td>
                          <td>{{$item['priority']}}</td>
                          <td>{{$item['prf_qty']}}</td>

                          <td><a href="{{route('purchase_request.delete_item',$index)}}" class="btn btn-danger">Delete</a></td>
                      </tr>
                      @endforeach
                      @endif
                      </tbody>
                    </table>

                    <button type="submit" class="btn btn-success me-2" name="button" value="complete">Complete</button>

                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
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

    document.getElementById("stock_no").value = selectedItem.stock_number;
    document.getElementById("uom").value = selectedItem.unit;

  }


</script>
@endsection
