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
                                    <select class="form-control df_input" name="df_no" id="df_no" placeholder="DF No">
                                        <option value="" selected disabled>Select DF No</option>
                                        @foreach ($df_list as $row)
                                            <option value="{{ $row->id }}">{{ $row->df_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" readonly class="form-control" name="requested_by_id"
                                    id="requested_by_id">
                                <div class="form-group col-md-5">
                                    <label>Requested By</label>
                                    <input type="text" readonly class="form-control" name="requested_by"
                                        id="requested_by">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Required Date</label>
                                    <input type="date" readonly class="form-control" name="required_date"
                                        id="required_date">
                                </div>
                            </div>

                            <div class="items_table"></div>


                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <a href="{{ route('df_approve.index') }}" class="btn btn-danger">Cancel</a>
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

        $(".df_input").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ route('df_approve.getDfData') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    df_id: id
                },
                success: function(response) {
                    $('#requested_by_id').val(response?.create_user?.id)
                    $('#requested_by').val(response?.create_user?.name)
                    $('#required_date').val(response?.required_date)
                }
            });
            $.ajax({
                url: "{{ route('df_approve.getDfApprovedItems') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    df_id: id
                },
                success: function(response) {
                    $('.items_table').html(response);
                }
            });
        });

        function onItemQtyChange(e, availableQty, index) {
            if (e.value > availableQty) {
                alertDanger(`DF Available Quantity exceeded on item ${index+1}`)
                e.value = availableQty;
                return
            }
        }
    </script>
@endpush
