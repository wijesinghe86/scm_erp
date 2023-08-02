@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('dispatch_approval.store') }}">
                            @csrf
                            <h4 class="card-title">Dispatch Approval</h4>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Dispatch No</label>
                                    <input value="{{ $dispatch_item->dispatch_no }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dispatched Date</label>
                                    <input value="{{ $dispatch_item->date }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>FGRN No</label>
                                    <input value="{{ $dispatch_item->finished_good->fgrn_no }}" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Dispatch From</label>
                                    <input value="{{ $dispatch_item->items[0]->warehouse_from->warehouse_name }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total No.of Dispatched Items</label>
                                    <input value="{{ $dispatch_item->tot_no_dispatch_items }}" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total No.of Dispatched Qty</label>
                                    <input value="{{ $dispatch_item->tot_no_dispatch_qty }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total No.of Dispatched Weight</label>
                                    <input value="{{ $dispatch_item->tot_no_dispatch_weight }}" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Fleet No</label>
                                    <input value="{{ $dispatch_item->fleet->fleet_name }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Driver Name</label>
                                    <input value="{{ $dispatch_item->driver_name }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Dispatched By</label>
                                    <input value="{{ $dispatch_item->dispatchedBy->employee_fullname }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Dispatched Date Time</label>
                                    <input value="{{ $dispatch_item->dispatched_at }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remarks</label>
                                    <input value="{{ $dispatch_item->dispatched_remark }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Inspected By</label>
                                    <input value="{{ $dispatch_item->inspectedBy->employee_fullname }}"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Inspected Date Time</label>
                                    <input value="{{ $dispatch_item->inspected_at }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remarks</label>
                                    <input value="{{ $dispatch_item->inspected_remark }}" class="form-control" readonly>
                                </div>
                            </div>

                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered form-group">
                                    <thead>
                                        <tr>
                                            {{-- <th></th> --}}
                                            <th colspan="2">
                                                <table class="table">
                                                    <tr>
                                                        <td align="center" colspan="2">Finished Products</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stock No</td>
                                                        <td>Description</td>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th>U/M</th>
                                            <th>Serial No</th>
                                            <th>Production Qty</th>
                                            <th>Production Weight</th>
                                            <th>Batch No</th>
                                            <th colspan="3">
                                                <table class="table">
                                                    <tr>
                                                        <td align="center" colspan="3">Dispatching</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dispatch Qty</td>
                                                        <td>Dispatch Weight</td>
                                                        <td>Dispatch To</td>
                                                    </tr>
                                                </table>
                                            </th>
                                            <th align="center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dispatch_item->items as $index => $item)
                                            <tr>
                                                <td>
                                                    {{ $item->stock_item->stock_number }}
                                                </td>
                                                <td>{{ $item->stock_item->description }}</td>
                                                <td>{{ $item->stock_item->unit }}</td>
                                                <td>{{ $item->finished_good_items->semi_product_serial_no }}</td>
                                                <td>{{ $item->finished_good_items->pro_qty }}</td>
                                                <td>{{ $item->finished_good_items->pro_weight }}</td>
                                                <td>{{ $item->finished_good_items->batch_no }}</td>
                                                <td>{{ $item->dispatch_qty }}</td>
                                                <td>{{ $item->dispatch_weight }}</td>
                                                <td>{{ $item->warehouse_to->warehouse_name }}</td>
                                                @if ($item->approve_status == null)
                                                    <td>
                                                        <select style="width:15rem;" required class="form-control"
                                                            name="items[{{ $index }}][status]">
                                                            <option value="" selected> Select Status</option>
                                                            <option value="approved">Approve</option>
                                                            <option value="rejected">Reject</option>
                                                        </select>
                                                        <input type="hidden" name="items[{{ $index }}][id]"
                                                            value="{{ $item->id }}" />
                                                    </td>
                                                @else
                                                    <td>
                                                        <input style="width:15rem;" readonly class="form-control"
                                                            value="{{ $item->approve_status }}" />
                                                        <input type="hidden" name="items[{{ $index }}][id]"
                                                            value="{{ $item->id }}" />
                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            @if (count($dispatch_item->items->whereNull('approve_status')) > 0)
                                <button class="btn btn-success me-2">Submit</button>
                            @endif
                            <a href="{{ route('dispatch_approval.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
