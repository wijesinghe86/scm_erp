@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Demand Forecasting Entry</h4>
                        <form class="forms-sample" method="POST" action="{{ route('demand-forecasting.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>DF No</label>
                                    <input type="text" class="form-control" name="df_no" id="df_no"
                                        placeholder="DF No" value="{{$next_number}}" readonly>
                                </div>                               
                                    <div class="form-group col-md-2">
                                      <label>Material Request No</label>
                                      <select class ="form-control mr_input" name="mrf_no" id="mrf_no" placeholder="MRF No" >
                                      <option value="" selected disabled>Select MRF No</option>
                                            @foreach ($mr_list as $row)
                                                <option value="{{ $row->id }}">{{ $row->mrf_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                <div class="form-group col-md-2">
                                    <label>DF Date</label>
                                    <input type="date" class="form-control" name="df_date" id="df_date">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Requested By</label>
                                    <select class="form-control" name="requested_by" placeholder="Reqested By">
                                        <option value="" selected disabled>Select Requested By</option>
                                        @foreach ($employees as $employee)
                                       <option value="{{$employee->id}}"> {{$employee->employee_fullname}} - {{$employee->departmentData->department_name}} ({{$employee->sectionData->section_name}})</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Required Date</label>
                                    <input type="date" class="form-control" name="required_date" id="required_date">
                                </div>
                            </div>
                           
                            <div class="items_table"></div>

                            <button type="submit" class="btn btn-success me-2">Complete Demand Forecasting</button>
                            <a href="{{ route('demand-forecasting.index') }}" class="btn btn-danger">Go to DF Registry</a>

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
            $('.items_table');
        });
        $(".mr_input").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ route('demand-forecasting.getMrfItems') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {mr_id: id},
                success: function(response) {
                    $('.items_table').html(response);
                }
            });
        });

        </script>
@endpush
