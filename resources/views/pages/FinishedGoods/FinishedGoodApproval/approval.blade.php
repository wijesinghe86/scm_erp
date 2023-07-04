@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Finished Goods Inspect</h4>
                        @if ($finished_good->inspected_by != null)
                            <div style="display: flex; justify-content: flex-end;" > <span style="font-size:16px;text-transform: uppercase" class="badge badge-primary float-right">{{ $finished_good->status }}</span></div>
                        @endif
                        <div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    <input value="{{ $finished_good->date }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>FGRN No</label>
                                    <input value="{{ $finished_good->fgrn_no }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse</label>
                                    <input value="{{ $finished_good->warehouse->warehouse_name }}" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Production Start Date Time</label>
                                    <input value="{{ $finished_good->pro_start_date_time }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Production End Date Time</label>
                                    <input value="{{ $finished_good->pro_end_date_time }}" class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>RMI No</label>
                                    <input value="{{ $finished_good->rmi->rmi_no }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Issued Weight</label>
                                    <input value="{{ $finished_good->tot_issue_weight }}" type="text" readonly
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Production Qty</label>
                                    <input value="{{ $finished_good->tot_pro_qty }}" type="text" readonly
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Total Production Weight</label>
                                    <input value="{{ $finished_good->tot_pro_weight }}" type="text" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Total Wastage</label>
                                    <input value="{{ $finished_good->tot_wastage }}" type="text" readonly
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remaining Raw Materials</label>
                                    <input value="{{ $finished_good->remaining_qty }}" type="text" readonly
                                        class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
                            <h5>Finish Products</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table  table-bordered form-group">
                                    <thead>
                                        <tr>
                                            <th>RMI Stock No</th>
                                            <th>Description</th>
                                            <th style="min-width: 150px; width: 150px;">Issued Serial No</th>
                                            <th style="min-width: 100px; width: 100px;">Issued Weight</th>
                                            <td>
                                                <table class="table">
                                                    <tr>
                                                        <td align="center" colspan="2">Finished Product</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="min-width: 150px; width: 150px;">Stock No</td>
                                                        <td style="min-width: 150px; width: 150px;">Description</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <th style="min-width: 100px; width: 100px;">Production Qty</th>
                                            <th style="min-width: 100px; width: 100px;">Production Weight</th>
                                            <th style="min-width: 130px; width: 130px;">Batch No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (collect($finished_good->items)->groupBy('rmi_item_stock_number') as $rmi_item_stock_number => $items)
                                            <tr>
                                                <td class="align-top">{{ $rmi_item_stock_number }}</td>
                                                <td class="align-top">{{ $items[0]['rmi_item_stock_description'] }}</td>
                                                <td colspan="7">
                                                    <table class="table">
                                                        @foreach (collect($items)->groupBy('semi_product_serial_no') as $semi_product_serial_no => $items)
                                                            <tr>
                                                                <td style="min-width: 150px; width: 150px;"
                                                                    class="align-top">
                                                                    {{ $semi_product_serial_no }}</td>
                                                                <td style="min-width: 150px; width: 150px;"
                                                                    class="align-top">
                                                                    {{ $items[0]['rmi_qty'] }}</td>
                                                                <td>
                                                                    <table class="table table-striped">
                                                                        @foreach ($items as $index => $item)
                                                                            <tr>
                                                                                <td style="min-width: 150px; width: 150px;"
                                                                                    class="align-top">
                                                                                    {{ $item['pro_stock_no'] }}</td>
                                                                                <td style="min-width: 150px; width: 150px;"
                                                                                    class="align-top">
                                                                                    {{ $item['pro_description'] }}</td>
                                                                                <td style="min-width: 100px; width: 100px;"
                                                                                    class="align-top">
                                                                                    {{ $item['pro_qty'] }}</td>
                                                                                <td style="min-width: 100px; width: 100px;"
                                                                                    class="align-top">
                                                                                    {{ $item['pro_weight'] }}</td>
                                                                                <td align="right"
                                                                                    style="min-width: 100px; width: 100px;"
                                                                                    class="align-top">
                                                                                    {{ $item['batch_no'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <br>
                            <h5>Wastag</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Stock No</th>
                                            <th>Description</th>
                                            <th>U/M</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($finished_good->wastage_items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item['wastage_stock_number'] }}</td>
                                                <td>{{ $item['wastage_description'] }}</td>
                                                <td>{{ $item['stock_item']['unit'] }}</td>
                                                <td>{{ $item['qty'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($finished_good->inspected_by == null)
                                <form style="margin-top: 20px;" method="POST"
                                    action="{{ route('finished_goods_approval.store', $finished_good->id) }}">
                                    @csrf
                                    <div class="form-group col-md-3">
                                        <label>Status</label>
                                        <select required name="status" class="form-control item-select">
                                            <option value="" selected disabled>Select Finish Good Item</option>
                                            <option value="approved">Approved</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success me-2">Submit</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
