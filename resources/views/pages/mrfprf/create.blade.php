@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Purchase Request Entry for Material Request </h4>
                        <form class="forms-sample" method="POST" action="{{ route('mrfprf.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>PRF No</label>
                                    <input type="text" class="form-control" name="mrfprf_no" id="mrfprf_no" value="{{$next_number}}"
                                        placeholder="PRF No" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label>PRF Date</label>
                                    <input type="date" class="form-control" name="mrfprf_date" id="mrfprf_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                  <label>Material Request No</label>
                                  <select class ="form-control mr_input" name="mr_id" id="mr_id" placeholder="MRF No" >
                                  <option value="" selected disabled>Select MRF No</option>
                                        @foreach ($mr_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->mrf_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="prfitems_table"></div>

                            <button type="submit" class="btn btn-success me-2">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
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
@endpush
