@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title">New {{ $setting->invoice_type_name }} Creation</h4>
                        <br>
                        <form class="forms-sample" method="POST" action="{{ route('employee.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input type="text" class="form-control" id="customer_code" name="customer_code"
                                        placeholder="Customer Code" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Customer Name</label>
                                    <select class="form-control item-select" name="customer_id" id="customer_id"
                                        onchange="getCustomer()">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Customer Address</label>
                                    <input type="text" class="form-control" id="customer_address_line1"
                                        name="customer_address_line1" placeholder="Customer Address" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Customer VAT Number</label>
                                    <input type="text" class="form-control" id="customer_vat_number"
                                        name="customer_vat_number" placeholder="Customer VAT Number" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Invoice Number</label>
                                    <input type="text" class="form-control" name="invoice_number" id="invoice_number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Invoice Date</label>
                                    <input type="date" class="form-control" name="invoice_date" id="invoice_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Employee Code</label>
                                    <input type="text" class="form-control" id="employee_reg_no" name="employee_reg_no"
                                        placeholder="Customer Code" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Employee Name</label>
                                    <select class="form-control item-select" name="employee_id" id="employee_id"
                                        onchange="getEmployee()">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->employee_fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Ref No</label>
                                    <input type="text" class="form-control" name="ref_number"
                                        placeholder="Employee Residential Address 1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Invoice Category</label>
                                    <input type="text" class="form-control" name="category"
                                        placeholder="Invoice Category">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>PO NO</label>
                                    <input type="text" class="form-control" name="po_number" placeholder="PO NO">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Payment Terms</label>
                                    <select class="form-control" name="payment_terms">
                                        <option {{ ($customers->customer_type_of_customer =="0"?"selected":"") }} value="">Select type</option>
                                        <option  value="1">Cash</option>
                                        <option  value="2">Credit</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Item Count</label>
                                    <input type="text" class="form-control" name="item_count" placeholder="Item Count">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Sub Total</label>
                                    <input type="text" class="form-control" name="sub_total"
                                        placeholder="Sub Total">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>VAT %</label>
                                    <input type="text" class="form-control" name="vat"
                                        placeholder="VAT %">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>VAT Amount</label>
                                    <input type="text" class="form-control" name="vat_amount"
                                        placeholder="VAT Amount">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Net Total</label>
                                    <input type="email" class="form-control" name="net_total"
                                        placeholder="Net Total">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Discount %</label>
                                    <input type="text" class="form-control" name="Total_discount_percentage" placeholder="Discount %">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Discount Amount</label>
                                    <input type="text" class="form-control" name="Total_discount_amount"
                                        placeholder="Discount Amount">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Grand Total</label>
                                    <input type="text" class="form-control" name="grand_total" placeholder="Grand Total">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2">Update Invoice</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function getCustomer() {
            var customer_id = $('#customer_id').val();
            console.log(customer_id);
            var data = {
                customer_id: customer_id
            };
            $.ajax({
                url: "{{ route('customer.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#customer_code').val(response.customer_code);
                    $('#customer_address_line1').val(response.customer_address_line1);
                    $('#customer_vat_number').val(response.customer_vat_number);
                }
            });
        }

        function getEmployee() {
            var employee_id = $('#employee_id').val();
            console.log(employee_id);
            var data = {
                employee_id: employee_id
            };
            $.ajax({
                url: "{{ route('employee.get.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#employee_reg_no').val(response.employee_reg_no);
                }
            });
        }
    </script>
@endpush
