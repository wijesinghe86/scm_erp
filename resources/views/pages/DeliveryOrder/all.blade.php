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
                                    <h4 class="title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>All
                                        Delivery Order List</h4>
                                    {{-- <p class="category">This displays all active invoices in the system</p> --}}
                                </div>
                                {{-- <div class="col-md-4" style="display:flex;justify-content: flex-end;">
                                    <a href="{{ route('deliveryorders.new') }}"
                                        class="btn btn-success btn-round new-invoice-button">Issue Delivery Order</a>
                                </div> --}}
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <th>CUSTOMER NAME</th>
                                            <th>DELIVERY ORDER NUMBER</th>
                                            <th>INVOICE NUMBER</th>
                                            <th>INVOICE DATE</th>
                                            <th>LOCATION</th>
                                            <th>ISSUED DATE</th>
                                            <th>ISSUED BY</th>
                                            <th>ACTION</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deliveryOrders as $key => $deliveryOrder)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $deliveryOrder->customer->customer_name }}</td>
                                                <td>{{ $deliveryOrder->delivery_order_no }}</td>
                                                <td>{{ $deliveryOrder->invoice_number }}</td>
                                                <td>{{ $deliveryOrder->invoice_date }}</td>
                                                <td>{{ optional($deliveryOrder->location)->warehouse_name }}</td>
                                                <td>{{ $deliveryOrder->issued_date? $deliveryOrder->issued_date: "Not Issued" }}</td>
                                                <td>{{ $deliveryOrder->createdBy ? $deliveryOrder->createdBy->name : 'User not found' }}
                                                </td>
                                                <td align="right">
                                                    <a class="h4"
                                                        href="{{ route('deliveryorders.view', $deliveryOrder->id) }}">
                                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                                    </a>


                                                    {{-- <a class="h4"
                                                        href="{{ route('stockitem.edit', $deliveryOrder->id) }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    <a class="h4"
                                                        href="{{ route('stockitem.delete', $deliveryOrder->id) }}">
                                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
