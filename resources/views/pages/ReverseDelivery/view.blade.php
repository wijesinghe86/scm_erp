@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Urgent Delivery No: {{ $urgent_delivery->delivery_order_no }}</h2>
                            <br>

                             <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('reverse_delivery.index') }}" class="btn btn-success mb-2 float-end mb-2"> Back</a>
                            </div>
                            <table class="table table-bordered" id="delivery-table">

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
                                    @foreach ($urgent_delivery->items as $issued_items)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ optional($issued_items->item)->stock_number }}</td>
                                        <td>{{ optional($issued_items->item)->description }}</td>
                                        <td>{{ optional($issued_items->item)->unit }}</td>
                                        <td>{{ $issued_items->issued_qty }}</td>
                                    </tr>
                                @endforeach
                                    
                                </tbody>
                            </table>
                             {{-- <div style="display: flex;justify-content: flex-end; align-items: center; margin: 20px 0"> --}}
                                {{-- <a target="_blank" href="{{ route('sales_order.print', ['invoice_id' => $invoices->id]) }}" class="btn btn-success mb-2 float-end mb-2"> Print</a>  --}}
                                <div style="display: flex;justify-content: flex-end; align-items: center; margin: 20px 0">
                                    <a target="_blank" href="{{ route('reverse_delivery.print', ['urgent_delivery_id' => $urgent_deliveries->id]) }}"
                                        class="btn btn-secondary mr-5"> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('#delivery-table').DataTable(

            );
        });
    </script> --}}
@endpush

@push('styles')
    <style>
        a {
            text-decoration: none;
        }
    </style>
@endpush
