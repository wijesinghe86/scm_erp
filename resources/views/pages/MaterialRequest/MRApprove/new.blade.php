@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Material Request Approval Form</h4>
                        <form class="forms-sample" method="POST" action="{{ route('mr_request_approve.store') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-2">
                                  <label>Material Request No</label>
                                  <select class ="form-control mr_input" name="mrf_no" id="mrf_no" placeholder="MRF No" onchange="itemOnChange(this)">
                                     <option value="" selected disabled>Select MRF No</option>
                                        @foreach ($mr_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->mrf_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Requested By</label>
                                    <input type="text" readonly class="form-control" name="requested_by" id="requested_by" >
                                  </div>
                                  <div class="form-group col-md-3">
                                    <label>Required Date</label>
                                    <input type="date" readonly class="form-control" name="required_date" id="required_date">
                                  </div>
                            </div>

                            <div class="items_table"></div>


                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <button class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
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

      document.getElementById("requested_by").value = selectedMr.requested_by.employee_fullname;
      document.getElementById("required_date").value = selectedMr.required_date;

    }
    </script>
    <script>
        $(document).ready(function() {
            // alert("ss");
            // $('.items_table');
        });

        $(".mr_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/material-request-approve/get-items?mr_id=' + id, function() {

            });
        });



    </script>
@endpush
