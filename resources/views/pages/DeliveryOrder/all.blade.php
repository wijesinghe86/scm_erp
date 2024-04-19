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
                                <br>
                                <br>

                            <div class="container mt-3">
                                <div class="row">
                                  <div class="col-md-2">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <br><br>
                                  </div>
                                </div>


                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
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
                                    <tbody  id="invoices-table">
                                        @foreach ($deliveryOrders as $key => $deliveryOrder)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $deliveryOrder->customer->customer_name }}</td>
                                                <td>{{ $deliveryOrder->delivery_order_no }}</td>
                                                <td>{{ $deliveryOrder->invoice_number }}</td>
                                                <td>{{ $deliveryOrder->invoice_date }}</td>
                                                <td>{{ optional($deliveryOrder->location)->warehouse_name }}</td>
                                                <td>{{ $deliveryOrder->issued_date? $deliveryOrder->issued_date: "Not Issued" }}</td>
                                                <td>{{ optional($deliveryOrder->items[0]->issued)->name }}
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
                                {{ $deliveryOrders->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endsection

            @push('scripts')
                <script>
     $(document).ready(function(){
         $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#invoices-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

                </script>
            @endpush
