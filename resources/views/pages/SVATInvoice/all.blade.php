@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">SVAT Invoices Record</h4>
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('svatinvoices.new') }}" class="btn btn-success mb-2"> Add New </a>
                            </div>
                            <table class="table table-bordered" id="tbl_svatinvoice-table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <th>INVOICE NUMBER</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>INVOICE AMOUNT</th>
                                        <th>SALES STAFF</th>
                                        <th>STATUS</th>
                                        <th>CREATED BY</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->customer_id }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td>{{ $invoice->mstaff_id }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>{{ $invoice->createUser ? $item->createUser->name : 'User not found' }}</td>
                                            <td>
                                            </td>
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
                $('#tbl_svatinvoice-table').DataTable(

                );
            });
        </script>
    @endpush
