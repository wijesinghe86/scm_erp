@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Semi Finished Goods Serial Code Assigning</h4>
                        <form class="forms-sample" method="POST" action="{{ route('semifinishedgoodsserialcodeassigning.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Semi Finished Goods Serial Number</label>
                                    <input type="text" class="form-control" name="semi_finished_goods_serial_number" placeholder="Semi Finished Goods Serial Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Goods Receiving Number</label>
                                    <input type="text" class="form-control" name="grn_number" placeholder="Goods Receiving Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Warehouse Code</label>
                                    <select class="form-control item-select" name="warehouse_code">
                                        @foreach ($warehouses as $warehouse )
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Stock Number</label>
                                    <input type="text" class="form-control" name="stock_number" placeholder="Stock Number">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Raw Materials Serial Quantity</label>
                                    <input type="text" class="form-control" name="rm_serial_quantity" placeholder="Raw Materials Serial Quantity">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Raw Materials Serial Weight</label>
                                    <input type="text" class="form-control" name="rm_serial_weight" placeholder="Raw Materials Serial Weight">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Job Order Number</label>
                                    <input type="text" class="form-control" name="job_order_number" placeholder="Job Order Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Batch Number</label>
                                    <input type="text" class="form-control" name="batch_number" placeholder="Job Order Number">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success me-2">ADD</button>

                            <hr>

                            <table class="table table-bordered" id="tbl_goodsreceiveds">
                                <thead>
                                    <tr>
                                        <td>Stock Number</td>
                                        <td>Raw Materials Serial Quantity</td>
                                        <td>Raw Materials Serial Weight</td>
                                        <td>Job Order Number</td>
                                        <td>Batch Number</td>
                                     </tr>
                                </thead>

                                <tbody>

                                </tbody>

                            </table>

                            <hr>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Created By</label>
                                    <input type="text" class="form-control" name="created_by" placeholder="Created By">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Created Date</label>
                                    <input type="date" class="form-control" name="created_date" placeholder="Created Date">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success me-2">Complete Semi Finished Goods</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('.item-select').select2(
            {
                placeholder: "Select Item",
            });
    });

</script>
@endpush

@push('styles')
<style>
    .select2-container .select-selection--single{
        height: 46px;
    }
    </style>

@endpush
