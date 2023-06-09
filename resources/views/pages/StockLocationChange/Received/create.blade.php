@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Stock Location Change Entry</h4>

                        <div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SLC Number</label>
                                    <input readonly value="{{ $slc->slc_number }}" class="form-control">
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
                                                <td>{{ $item->stock_item->stock_number }}</td>
                                                <td>{{ $item->stock_item->description }}</td>
                                                <td>{{ $item->stock_item->unit }}</td>
                                                <td>{{ $item->qty }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <hr>
                            <br>
                            @if ($slc->received_by != null)
                                <div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Approved Date</label>
                                            <input readonly value="{{ $slc->received_date }}" type="datetime-local"
                                                class="form-control" name="received_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Approved by</label>
                                            <select readonly value="{{ $slc->received_by }}" class="form-control item-select"
                                                name="received_by">
                                                <option {{ $slc->received_by == null ? 'selected' : '' }} value="">
                                                    Select
                                                    Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option {{ $slc->received_by == $employee->id ? 'selected' : '' }}
                                                        value="{{ $employee->id }}">
                                                        {{ $employee->employee_fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Remark</label>
                                            <input readonly value="{{ $slc->received_remark }}" type="text" class="form-control"
                                                name="received_remark">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($slc->received_by == null)
                                <form method="POST" action="{{ route('stocklocationchange_received.store', $slc->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Approved Date</label>
                                            <input value="{{ $slc->received_date }}" type="datetime-local"
                                                class="form-control" name="received_date">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Approved by</label>
                                            <select value="{{ $slc->received_by }}" class="form-control item-select"
                                                name="received_by">
                                                <option {{ $slc->received_by == null ? 'selected' : '' }} value="">
                                                    Select
                                                    Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option {{ $slc->received_by == $employee->id ? 'selected' : '' }}
                                                        value="{{ $employee->id }}">
                                                        {{ $employee->employee_fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Remark</label>
                                            <input value="{{ $slc->received_remark }}" type="text" class="form-control"
                                                name="received_remark">
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
