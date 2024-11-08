@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Invoice Records</h2>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('invoices.new') }}" class="btn btn-success mb-2 float-end mb-2"> Add new </a>
                            </div>
                            <div class="content table-responsive table-full-width"> </div>
                            <table class="table bordered form-group">
                            <table class="table table-bordered" id="invoices-table">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>INVOICE DATE</td>
                                        <th>INVOICE NO</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>SALES STAFF NAME</th>
                                        <th>STATUS</th>
                                        <th>INVOICE TYPE</th>
                                        <th>CREATED BY</th>
                                        {{-- <th>CREATED AT</th> --}}
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->Customer ? $invoice->Customer->customer_name : 'Customer not found' }}
                                            </td>
                                            <td>{{ $invoice->SalesStaff ? $invoice->SalesStaff->employee_name_with_intial : 'Sales Staff not found' }}
                                            </td>
                                            <td style="color: red">{{ $invoice->cancel_status }}</td>
                                            <td>{{ $invoice->payment_terms }}</td>
                                            <td>{{ $invoice->createUser ? $invoice->createUser->name : 'User not found' }}
                                            </td>
                                            {{-- <td>{{ $invoice->created_at }}</td> --}}
                                            <td>
                                                <a href="{{ route('invoices.preview', $invoice->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye text-info"></i>
                                                </a>
                                                <a href="">
                                                    <i class="fa-sharp fa-solid fa-trash text-danger"></i>
                                                </a>
                                                <a href="">
                                                    <i class="fa-sharp fa-solid fa-print"></i>
                                                </a>
                                                <a href="{{ route('invoices.cancel', $invoice->id) }}">

                                                <i class="fa-solid fa-rectangle-xmark text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </table>
                            {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#invoices-table').DataTable(

            );
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
