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
                                    <h4 class="title"><a href="{{ route('dashboard') }}"><i
                                                class="mdi mdi-home"></i></a>Customer Returns Approved Registry</h4>
                                </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped" id="return-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>RETURN NUMBER</th>
                                            <th>INVOICE NUMBER</th>
                                            <th>CREATED BY</th>
                                            <th>APPROVED BY</th>
                                            <th>LOCATION</th>
                                            <th>RETURNED DATE</th>
                                            <th>VIEW</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice_returns as $key => $invoice_return)
                                            <tr>
                                                <form method="POST"
                                                    action="{{ route('returns.approval', $invoice_return->id) }}">
                                                    @csrf
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $invoice_return->return_no }}</td>
                                                    <td>{{ $invoice_return->invoice->invoice_number }}</td>
                                                    <td>{{ $invoice_return->createdBy->name }}</td>
                                                    <td>{{ $invoice_return->approvedBy ? $invoice_return->approvedBy->name : 'Not Approved' }}
                                                    </td>
                                                    <td>{{ $invoice_return->location->warehouse_name }}</td>
                                                    <td>{{ date('Y-m-d', strtotime($invoice_return->created_at)) }}</td>
                                                     <td style="display:flex;gap:1rem; align-items: center;" align="right">
                                                        {{-- @if ($invoice_return->is_approved)
                                                        <button type="submit"
                                                            class="btn btn-success">Approve</button>
                                                            @endif --}}
                                                       <a class="h4"
                                                            href="{{ route('returns.view', $invoice_return->id) }}">
                                                            <i class="fa-sharp fa-solid fa-eye"></i>

                                                        </a>
                                                    </td>
                                                </form>
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
