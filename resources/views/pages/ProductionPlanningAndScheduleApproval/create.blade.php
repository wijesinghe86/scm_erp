@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Production Planning And Schedule Approval Form</h4>
                        <form class="forms-sample" method="POST"
                            action="{{ route('production_planning_and_schedule_approval.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Production Planing No</label>
                                    <select class="form-control pps_select" name="pps_no" id="pps_no"
                                        placeholder="PPS No">
                                        <option value="" selected disabled>Select PPS No</option>
                                        @foreach ($production_plannings as $row)
                                            <option value="{{ $row->id }}">{{ $row->pps_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="items_table"></div>


                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <a href="{{route('production_planning_and_schedule_approval.index')}}" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(".pps_select").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ route('production_planning_and_schedule_approval.getItems') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    pps_id: id
                },
                success: function(response) {
                    $('.items_table').html(response);
                }
            });
        });
    </script>
@endpush
