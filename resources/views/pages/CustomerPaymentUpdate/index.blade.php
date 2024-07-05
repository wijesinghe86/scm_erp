@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Customer Payment Regsitry</h2>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('customerpayment.create') }}" class="btn btn-success mb-2 float-end mb-2"> New Payment </a>
                            </div>

                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="payment-table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>CUSTOMER CODE</td>
                                        <th>CUSTOMER NAME</th>
                                        <th>INVOICE NO</th>
                                        <th>INVOICE AMOUNT</th>
                                        <th>PAID AMOUNT</th>
                                        <th>CREATED BY </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $customerPaymentUpdates as  $customerPaymentUpdate )
                                    <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($customerPaymentUpdate)->customer_code }}</td>
                                    <td>{{ optional($customerPaymentUpdate->customer)->customer_name}}</td>
                                    <td>{{ optional($customerPaymentUpdate->invoice)->invoice_number}}</td>
                                    <td>{{ optional($customerPaymentUpdate->invoice)->grand_total}}</td>
                                    <td>{{ optional($customerPaymentUpdate)->received_amount}}</td>
                                    <td>{{optional($customerPaymentUpdate->createuser)->name  }}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#payment-table').DataTable();
    });
</script>
@endpush

@push('styles')
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endpush

