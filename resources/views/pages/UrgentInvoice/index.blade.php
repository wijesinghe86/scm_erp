@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header">
                            <div style="margin-bottom: 20px;" class="row">
                                <div class="col-md-8">
                                    <h4 class="title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Reverse Invoice List</h4>
                                </div>
                                <div class="col-md-4" style="display:flex;justify-content: flex-end;">
                                    <a href="{{ route('urgent_invoice.create') }}"
                                        class="btn btn-success btn-round new-invoice-button">Create New</a>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="issuance-table">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <th>URGENT INVOICE NO</th>
                                        <th>DELIVERY ORDER NO</th>
                                        <th>INVOICE DATE</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>WAREHOUSE</th>
                                        <th>CREATED BY</th>
                                        <th>VIEW</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($urgentInvoices as $urgentInvoice)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$urgentInvoice->invoice_number }}</td>
                                            <td>{{optional($urgentInvoice->get_delivery)->delivery_order_no }}
                                            <td>{{$urgentInvoice->invoice_date }}</td>
                                            <td>{{$urgentInvoice->get_customer->customer_name}}</td>
                                            <td>{{ optional($urgentInvoice->location)->warehouse_name }}</td>
                                            <td>{{ optional($urgentInvoice->created_user)->name }}</td>
                                            <td>
                                                <a href="{{ route('urgent_invoice.view', $urgentInvoice->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye text-info"></i>
                                                </a>
                                            </td>



                                            {{-- </td>  --}}
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
            $('#issuance-table').DataTable(

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
