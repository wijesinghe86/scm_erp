@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title">Delivery Order</h4>
                        <br>
                        <form action="{{ route('deliveryorders.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" id="customer_code" name="customer_code"
                                        placeholder="Customer Code" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Name</label>
                                    <select class="form-control" name="customer_id" id="customer_id"
                                        onchange="getCustomer()">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Invoice No</label>
                                    <select class ="form-control invoice_input" name="invoice_number" id="invoice_number" placeholder="Invoice No" >
                                        <option value="" selected disabled>Select Invoice No</option>
                                              @foreach ($invoices as $row)
                                                  <option value="{{ $row->id }}">{{ $row->invoice_number }}</option>
                                              @endforeach
                                          </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Invoice Date</label>
                                    <input type="date" class="form-control" name="invoice_date" id="invoice_date">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>DO No</label>
                                    <input type="text" class="form-control" name="delivery_order_no" value="{{ $delivery_order_no}}"
                                        placeholder="Invoice Category">
                                </div>
                                {{-- <div class="form-group col-md-2">
                                    <label>Location</label>
                                    <select class="form-control item-select" name="location_id" id="location_id">
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">
                                                {{ $warehouse->warehouse_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                             </div>
                            {{-- <button type="button" class="btn btn-success me-2"
                                onclick="addInvoiceItem('{{ $invoice_number }}')">Add</button> --}}
                            <div class="row">
                                <div class="items-table">
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-success me-2">Complete Delivery Order</button>
                                <button type="button" class="btn btn-gradient-success btn-fill btn-wd">Print</button>
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
        $(document).ready(function() {
            $('.items_table');
        });
        $(".invoice_input").change(function() {
            var id = $(this).val();
            $(".items_table").load('/deliveryorders/get-items?invoice_no=', function() {
            });
        });

   


        </script>
@endpush
