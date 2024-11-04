@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a> Stock Status Report</h3>
                        <br>
                        <br>
                        <h4><b>1. Stock Item wise History Report</b></h4>
                        <form method="POST" target="_blank"  action="{{ route('stockreports.generate_history_report') }}">
                            @csrf
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Warehouse</label>
                                    <select class="form-control select" id="warehouse_name" name="warehouse_name" required>
                                        <potion select disabled>Select Warehouse</potion>
                                        @foreach ($warehouse_lists as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Stock No</label>
                                    <input type="text" class="form-control" name="stock_no" id="stock_no"
                                        placeholder="Stock Number" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Description</label>
                                    <select class="form-control select" name="stock_item" id="stock_item"
                                        onchange="getStockItem()" required >
                                        <option selected disabled>Select Item</option>
                                        @foreach ($stock_item_lists as $stock)
                                            <option value="{{ $stock->id }}">{{ $stock->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <input type="hidden" value="366" class="form-control" name="customerId" id="frm_date"
                                        placeholder="frm_date"> --}}

                                <div class="form-group col-md-2">
                                    <label>From Date</label>
                                    <input type="date" class="form-control" name="frm_date" id="frm_date"
                                        placeholder="frm_date" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>To Date</label>
                                    <input type="date" class="form-control" name="to_date" id="to_date"
                                        placeholder="to_date" required>
                                </div>
                            </div>
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-success me-2" style="position: center"> View and
                                        Print</button>
                                </div>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('scripts')
    <script>
        const stockItemList = <?php echo json_encode($stock_item_lists); ?>;

        $(document).ready(function() {
            $('.select').select2({});
        })



        function getStockItem() {
            var stockItemId = $('#stock_item').val();
            const stockItem = stockItemList.find(row => row?.id == stockItemId)
            if (stockItem) {
                $('#stock_no').val(stockItem?.stock_number);
            }
        }
    </script>
@endpush
