@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Invoice No: {{ $invoices->invoice_number }}</h2>
                            <br>

                             <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('sales_order.index') }}" class="btn btn-success mb-2 float-end mb-2"> Back</a>
                            </div>
                            <table class="table table-bordered" id="invoices-table">

                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <th>STOCK NO</th>
                                        <th>DESCRIPTION</th>
                                        <th>UOM</th>
                                        <th>QTY</th>
                                        <td>LOCATION</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices->items as $key => $item)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                          <td>{{ $item->stock_no  }}</td>
                                            <td>{{ $item->description  }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->location->warehouse_name }}</td>
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
