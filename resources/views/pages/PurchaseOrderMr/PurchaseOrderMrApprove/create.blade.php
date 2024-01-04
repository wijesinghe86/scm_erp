@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Purchase Order Approval Form</h4>
                        <form class="forms-sample" method="POST"
                            action="{{ route('purchase_order_approve.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Purchase Order No</label>
                                    <select class="form-control po_select" name="po_no" id="po_no"
                                        placeholder="PO No">
                                        <option value="" selected disabled>Select PO No</option>
                                        @foreach ($purchase_orders as $row)
                                            <option value="{{ $row->id }}">{{ $row->po_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="form-group col-md-2">
                                    <label>Requested Date</label>
                                    <input type = "text" class="form-control" name="po_date" id="po_date"
                                        placeholder="po_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Requested by</label>
                                    <input type = "text" class="form-control" name="requested_by" id="requested_by"
                                        placeholder="requested_by">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>PO Value</label>
                                    <input type = "number" class="form-control" name="po_value" id="po_value"
                                        placeholder="PO Value">
                                </div> --}}
                            </div>

                            <div class="items_table"></div>


                            <button type="submit" class="btn btn-success me-2">Approved</button>
                            <a href="{{route('purchase_order_approve.index')}}" class="btn btn-danger">Go To PO Approal Registry</a>
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

        $(".po_select").change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ route('purchase_order_approve.getItems') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    po_id: id
                },
                success: function(response) {
                    $('#po_date').val(response?.po_date)
                    // $('#pps_edate').val(response?.end_date)
                }
            });
            $.ajax({
                url: "{{ route('purchase_order_approve.getItems') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: {
                    po_id: id
                },
                success: function(response) {
                    $('.items_table').html(response)

                }
            });
        });
    </script>
@endpush

