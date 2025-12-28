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
                                    <h4 class="title"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>Reverse Lgistics Return List</h4>
                                </div>
                                <div class="col-md-4" style="display:flex;justify-content: flex-end;">
                                    <a href="{{ route('reverse_returns.new') }}"
                                        class="btn btn-success btn-round new-invoice-button">Create New</a>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="issuance-table">

                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>RMRS NO</th>
                                        <th>INVOICE DATE</th>
                                        <th>URGENT INVOICE NO</th>
                                        <th>DELIVERY ORDER NO</th>
                                        <th>LOCATION</th>
                                        <th>RETURNED DATE</th>
                                        <th>APPROVED BY</th>
                                        <th>VIEW</th>
                                        



                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($urgent_return as $urgent_returns)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$urgent_returns->return_no }}</td>
                                            <td>{{$urgent_returns->invoice_id}}</td>
                                            <td>{{$urgent_returns->delivery_order_id }}</td> 
                                            <td align="right">
                                                    <a class="h4"
                                                        href="{{ route('reverse_returns.view', $urgent_returns->id ) }}">
                                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                                    </a>
                                                </td>
                                           



                                           
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
