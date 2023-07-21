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
                                        Returns</h4>
                                </div>
                                <div class="col-md-4" style="display:flex;justify-content: flex-end;">
                                    <a href="{{ route('returns.new') }}"
                                        class="btn btn-success btn-round new-invoice-button">Create Return</a>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="return-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>RETURN NUMBER</th>
                                            <th>INVOICE NUMBER</th>
                                            <th>INVOICE DATE</th>
                                            <th>CREATED BY</th>
                                            <th>PAYMENT METHOD</th>
                                            <th>LOCATION</th>
                                            <th>RETURNED DATE</th>
                                            <th>APPROVED BY</th>
                                            <th>ACTION</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice_returns as $key => $invoice_return)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $invoice_return->return_no }}</td>
                                                <td>{{ $invoice_return->invoice->invoice_number }}</td>
                                                <td>{{ $invoice_return->invoice->invoice_date }}</td>
                                                <td>{{ $invoice_return->createdBy->name }}</td>
                                                <td>{{ $invoice_return->payment_method }}</td>
                                                <td>{{ $invoice_return->location->warehouse_name }}</td>
                                                <td>{{ date("Y-m-d", strtotime($invoice_return->created_at)) }}</td>
                                                <td>{{ $invoice_return->approvedBy ? $invoice_return->approvedBy->name : 'Not Approved' }}
                                                <td align="right">
                                                    <a class="h4"
                                                        href="{{ route('returns.view', $invoice_return->id) }}">
                                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                                    </a>
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
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#return-table').DataTable();
        });
    </script>
@endpush
