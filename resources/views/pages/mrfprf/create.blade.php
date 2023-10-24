@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Procurement Request </h4>
                        <form class="forms-sample" method="POST" action="{{ route('mrfprf.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>PRF No</label>
                                    <input type="text" class="form-control" name="mrfprf_no" id="mrfprf_no" value="{{$next_number}}"
                                        placeholder="PRF No" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Requested by</label>
                                    <input type="text" class="form-control" name="requested_by" id="requested_by" 
                                        placeholder="requested_by" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Requested Date</label>
                                    <input type="text" class="form-control" name="req_date" id="req_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>PRF Date</label>
                                    <input type="date" class="form-control" name="mrfprf_date" id="mrfprf_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                  <label>Material Request No</label>
                                  <select class ="form-control mr_input" name="mr_id" id="mr_id" placeholder="MRF No" onchange="itemOnChange(this)" >
                                  <option value="" selected disabled>Select MRF No</option>
                                        @foreach ($mr_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->mrf_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="prfitems_table"></div>

                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            <a href="{{ route('mrfprf.index') }}" class="btn btn-danger">Go to PR Registry</a>
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
        $(".mr_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".prfitems_table").load('/mrfprf/get-items?mr_id=' + id, function() {

            });
        });

        </script>

<script type="application/javascript">
    var mr_list = '{!! $mr_list->toJson()!!}';
    mr_list = JSON.parse(mr_list);

    function itemOnChange(elem) {

      var selectedMr = mr_list.filter((row)=>{
        return row.id == elem.value;
      })

      if(selectedMr.length == 0){
        return;
      }

      selectedMr = selectedMr[0];

      console.log("selected mr",selectedMr);

      document.getElementById("requested_by").value = selectedMr.employee_id;
      document.getElementById("req_date").value = selectedMr.required_date;
    }
    </script>
@endpush
