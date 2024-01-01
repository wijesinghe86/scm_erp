@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Procurement Request Approval Form</h4>
                        <form class="forms-sample" method="POST"
                            action="{{ route('pr_request_approve.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Purchase Request No</label>
                                    <select class="form-control pr_select" name="pr_no" id="pr_no"
                                        placeholder="PR No">
                                        <option value="" selected disabled>Select PR No</option>
                                        @foreach ($purchase_requests as $row)
                                            <option value="{{ $row->id }}">{{ $row->mrfprf_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group col-md-2">
                                    <label>Requested Date</label>
                                    <input type = "text" class="form-control" name="pr_date" id="pr_date"
                                        placeholder="pr_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Requested by</label>
                                    <input type = "text" class="form-control" name="requested_by" id="requested_by"
                                        placeholder="requested_by">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Estimated Value</label>
                                    <input type = "number" class="form-control" name="est_value" id="est_value"
                                        placeholder="Estimated Value">
                                </div> --}}
                            </div>

                            <div class="items_table"></div>


                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <a href="{{route('pr_request_approve.index')}}" class="btn btn-danger">Go To PR Approal Registry</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {});

        $(".pr_select").change(function() {
            var id = $(this).val();
            // $.ajax({
            //     url: "{{ route('pr_request_approve.getItems') }}",
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     type: "GET",
            //     data: {
            //         prf_id: id
            //     },
            //     success: function(response) {
            //         $('#pr_date').val(response?.mr_id)
            //         // $('#pps_edate').val(response?.end_date)
            //     }
            // });
            $.ajax({
                url: "{{ route('pr_request_approve.getItems') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    prf_id: id
                },
                success: function(response) {
                    $('.items_table').html(response)

                }
            });
        });
    </script>
@endpush

