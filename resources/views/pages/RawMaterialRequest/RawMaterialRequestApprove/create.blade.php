@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Raw Material Request Approval Form</h4>
                        <form class="forms-sample" method="POST" action="{{ route('raw_material_request_approve.store') }}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Raw Material Request No</label>
                                    <select required class="form-control item-select clear-qty" name="rmr_id" id="rmr_id">
                                        <option value="" selected disabled>Select Item</option>
                                        @foreach ($rmr_list as $rmr)
                                            <option value="{{ $rmr->id }}">
                                                {{ $rmr->rmr_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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

                            <div id="item_cart"></div>

                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <button class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let rmrList = <?php echo json_encode($rmr_list); ?>;
            $('#rmr_id').on('change', function() {
                let rmrId = $(this).val();
                const rmrItem = rmrList.find(row => row?.id == rmrId)
                console.log(rmrItem);
                $('#requested_by').val(rmrItem?.requested_by?.employee_fullname);
                $('#required_date').val(rmrItem?.req_date);

                $.ajax({
                    url: "{{ route('raw_material_request_approve.viewCartTable') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        rmr_no: rmrId
                    },
                    success: function(response) {
                        $('#item_cart').html(response)
                    }
                });
            })
        </script>
    @endpush
@endsection
