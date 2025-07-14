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
                                    <h4 class="title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Reverse Delivery Order List</h4>
                                </div>
                                <div class="col-md-4" style="display:flex;justify-content: flex-end;">
                                    <a href="{{ route('reverse_delivery.create') }}"
                                        class="btn btn-success btn-round new-invoice-button">Create New</a>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="issuance-table">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <th>URGENT DELIVERY ORDER NO</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>ISSUED WAREHOUSE</th>
                                        <th>ISSUED DATE</th>
                                        {{-- <th>ITEMS</th> --}}
                                        <th>ISSUED BY</th>
                                        <th>VIEW</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($urgent_deliveries as $urgent_delivery)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$urgent_delivery->delivery_order_no }}</td>
                                            <td>{{$urgent_delivery->get_customer->customer_name}}</td>
                                            <td>{{ optional($urgent_delivery->location)->warehouse_name }}</td>
                                            <td>{{$urgent_delivery->issued_date }}</td>
                                                {{-- <td>
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th scope="col" >#</th>
                                                            <th scope="col" >S/No</th>
                                                            <th scope="col" >Descrition</th>
                                                            <th scope="col" >U/M</th>
                                                            <th scope="col" >Qty</th>
                                                        </tr>
                                                        @foreach ($urgent_delivery->items as $issued_items)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{ optional($issued_items->item)->stock_number }}</td>
                                                                <td>{{ optional($issued_items->item)->description }}</td>
                                                                <td>{{ optional($issued_items->item)->unit }}</td>
                                                                <td>{{ $issued_items->issued_qty }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td> --}}
                                                <td>{{$urgent_delivery->created_user->name }} </td>
                                                <td>
                                                <a href="{{ route('reverse_delivery.view', $urgent_delivery->id) }}">
                                                    <i class="fa-sharp fa-solid fa-eye text-info"></i>
                                                </a>
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
