@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Demand Forecasting Approval Form</h4>
                        <form class="forms-sample" method="POST" action="{{ route('df_approve.store') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-2">
                                  <label>Demand Forecast No</label>
                                  <select class ="form-control df_input" name="df_no" id="df_no" placeholder="DF No" onchange="itemOnChange(this)">
                                     <option value="" selected disabled>Select DF No</option>
                                        @foreach ($df_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->df_no }}</option>
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
{{-- <script type="application/javascript">
    var df_list = '{!! $df_list->toJson()!!}';
    df_list = JSON.parse(df_list);

    function itemOnChange(elem) {

      var selectedDf = df_list.filter((row)=>{
        return row.id == elem.value;
      })

      if(selectedDf.length == 0){
        return;
      }

      selectedDf = selectedDf[0];

      console.log("selected df",selectedDf);

      document.getElementById("requested_by").value = selectedMr.requested_by.employee_fullname;
      document.getElementById("required_date").value = selectedMr.required_date;

    }
    </script> --}}
    <script>
        $(document).ready(function() {
            // alert("ss");
            // $('.items_table');
        });

        $(".df_input").change(function() {
            var id = $(this).val();
            // alert("Handler for .change() called." + id);

            $(".items_table").load('/demand-forecast-approve/get-items?df_id=' + id, function() {

            });
        });



    </script>
@endpush
