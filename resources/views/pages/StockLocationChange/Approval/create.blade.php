@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Location Change Approval Entry</h4>
                        @if ($slc->approved_status != null)
                            <div style="display: flex; justify-content: flex-end;"> <span
                                    style="font-size:16px;text-transform: uppercase"
                                    class="badge badge-primary float-right">{{ $slc->approved_status }}</span></div>
                        @endif
                        <div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SLC Date</label>
                                    <input readonly value="{{ $slc->slc_date }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Issued Date</label>
                                    <input readonly value="{{ $slc->issued_date }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Issued by</label>
                                    <input readonly value="{{ $slc->issuedBy->employee_fullname }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>From Location</label>
                                    <input readonly value="{{ $slc->from_warehouse->warehouse_name }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>To Location</label>
                                    <input readonly value="{{ $slc->to_warehouse->warehouse_name }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remarks</label>
                                    <input readonly value="{{ $slc->remarks }}" class="form-control">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-bordered" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <th>Stock No</th>
                                            <th>Description</th>
                                            <th>U/M</th>
                                            <th>Issue Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slc->items as $index => $item)
                                            <tr>
                                                <td>{{ optional($item->stock_item)->stock_number }}</td>
                                                <td>{{ optional($item->stock_item)->description }}</td>
                                                <td>{{ optional($item->stock_item)->unit }}</td>
                                                <td>{{ $item->qty  }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <hr>
                            <br>
                            @if ($slc->approved_by != null)
                                <div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Approved Date</label>
                                            <input readonly value="{{ $slc->approved_date }}" type="datetime-local"
                                                class="form-control" name="approved_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Approved by</label>
                                            <select readonly value="{{ $slc->approved_by }}"
                                                class="form-control item-select" name="approved_by">
                                                <option {{ $slc->approved_by == null ? 'selected' : '' }} value="">
                                                    Select
                                                    Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option {{ $slc->approved_by == $employee->id ? 'selected' : '' }}
                                                        value="{{ $employee->id }}">
                                                        {{ $employee->employee_fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Status</label>
                                            <select readonly class="form-control item-select" name="approved_status">
                                                <option {{ $slc->approved_status == null ? 'selected' : '' }}
                                                    value="">
                                                    Select Status</option>
                                                <option {{ $slc->approved_status == 'approved' ? 'selected' : '' }}
                                                    value="approved">Approve</option>
                                                <option {{ $slc->approved_status == 'rejected' ? 'selected' : '' }}
                                                    value="rejected">Reject</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Remark</label>
                                            <input readonly value="{{ $slc->approved_remark }}" type="text"
                                                class="form-control" name="approved_remark">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($slc->approved_by == null)
                                <form method="POST" action="{{ route('stocklocationchange_approvals.store', $slc->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Approved Date</label>
                                            <input value="{{ $slc->approved_date }}" type="datetime-local"
                                                class="form-control" name="approved_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Approved by</label>
                                            <select value="{{ $slc->approved_by }}" class="form-control selection"
                                                name="approved_by">
                                                <option {{ $slc->approved_by == null ? 'selected' : '' }} value="">
                                                    Select
                                                    Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option {{ $slc->approved_by == $employee->id ? 'selected' : '' }}
                                                        value="{{ $employee->id }}">
                                                        {{ $employee->employee_fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Status</label>
                                            <select class="form-control item-select" name="approved_status">
                                                <option {{ $slc->approved_status == null ? 'selected' : '' }}
                                                    value="">
                                                    Select Status</option>
                                                <option {{ $slc->approved_status == 'approved' ? 'selected' : '' }}
                                                    value="approved">Approve</option>
                                                <option {{ $slc->approved_status == 'rejected' ? 'selected' : '' }}
                                                    value="rejected">Reject</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Remark</label>
                                            <input value="{{ $slc->approved_remark }}" type="text" class="form-control"
                                                name="approved_remark">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
     $(document).ready(function() {
            $('.selection').select2({
                placeholder: "Select",
            });
        });
</script>

@endpush
