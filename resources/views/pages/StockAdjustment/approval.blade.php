@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Adjustment</h4>
                        <div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock Adjustment Number</label>
                                    <input type="text" readonly value="{{ $stock_adjustment->stock_adjustment_number }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Stock Adjustment Date</label>
                                    <input type="text" readonly value="{{ $stock_adjustment->date }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Type</label>
                                    <input type="text" readonly value="{{ $stock_adjustment->type }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Created By</label>
                                    <input type="text" readonly
                                        value="{{ $stock_adjustment->createdBy->employee_fullname }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Created Date</label>
                                    <input type="text" readonly
                                        value="{{ date('Y-m-d', strtotime($stock_adjustment->created_at)) }}"
                                        class="form-control">
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tbl_goodsreceiveds">
                                    <thead>
                                        <tr>
                                            <td>From Stock Number</td>
                                            <td>Transfer To Stock Number</td>
                                            <td>Quantity</td>
                                            <td>Weight</td>
                                            <td>From Warehouse</td>
                                            <td>To Warehouse</td>
                                            <td>Justification</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stock_adjustment->items as $index => $item)
                                            <tr>
                                                <td>{{ optional(optional($item)->from_stock_item)->stock_number }}</td>
                                                <td>{{ optional(optional($item)->to_stock_item)->stock_number }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->weight }}</td>
                                                <td>{{ optional(optional($item)->fromWarehouse)->warehouse_name }}</td>
                                                <td>{{ optional(optional($item)->toWarehouse)->warehouse_name }}</td>
                                                <td>{{ $item->justification }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <hr>
                            <br>
                            @if ($stock_adjustment->approved_by)
                                <div class="row" >
                                    <div class="form-group col-md-4">
                                        <label>Approved By</label>
                                        <input type="text" readonly
                                            value="{{ $stock_adjustment->approvedBy->employee_fullname }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Approved Date</label>
                                        <input type="text" readonly
                                            value="{{ date('Y-m-d', strtotime($stock_adjustment->approved_at)) }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Status</label>
                                        <input type="text" readonly
                                            value="{{ $stock_adjustment->approved_status }}"
                                            class="form-control">
                                    </div>
                                </div>
                            @else
                                <form class="forms-sample" method="POST"
                                    action="{{ route('stockadjustment.approval', $stock_adjustment->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Approved By</label>
                                            <select class="form-control " name="approved_by">
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Status</label>
                                            <select class="form-control " name="approved_status">
                                                <option value="">Select Status</option>
                                                <option value="approved">Approve</option>
                                                <option value="rejected">Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button style="submit" class="btn btn-success">Submit</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
