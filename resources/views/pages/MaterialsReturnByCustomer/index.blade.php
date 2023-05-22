@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Materials Return By Customer Catalogue</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('materialsreturnbycustomer.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('materialsreturnbycustomer.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_materialsreturnbycustomer">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Customer Code</td>
                                    <td>Invoice Number</td>
                                    <td>Issue Document Number</td>
                                    <td>Stock Number</td>
                                    <td>Returned Quantity</td>
                                    {{-- <td>Warehouse Code</td>
                                    <td>Justification</td>
                                    <td>Received By</td>
                                    <td>Received Date</td>
                                    <td>Inspection Note</td>
                                    <td>Inspected By</td>
                                    <td>Inspected Date</td>
                                    <td>Approved By</td>
                                    <td>Approved Date</td>
                                    <td>Reason For Return</td> --}}

                                     <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($materialsreturnbycustomers as $materialsreturnbycustomer)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $materialsreturnbycustomer->customer_code}}</td>
                                    <td>{{ $materialsreturnbycustomer->invoice_number}}</td>
                                    <td>{{ $materialsreturnbycustomer->issue_document_number}}</td>
                                    <td>{{ $materialsreturnbycustomer->stock_number}}</td>
                                    <td>{{ $materialsreturnbycustomer->returned_quantity}}</td>
                                    <td>{{ $materialsreturnbycustomer->warehouse_code}}</td>
                                    <td>{{ $materialsreturnbycustomer->justification}}</td>
                                    <td>{{ $materialsreturnbycustomer->received_by}}</td>
                                    <td>{{ $materialsreturnbycustomer->received_date}}</td>
                                    <td>{{ $materialsreturnbycustomer->inspection_note}}</td>
                                    <td>{{ $materialsreturnbycustomer->inspectedby}}</td>
                                    <td>{{ $materialsreturnbycustomer->inspected_date}}</td>
                                    <td>{{ $materialsreturnbycustomer->approvedby}}</td>
                                    <td>{{ $materialsreturnbycustomer->approved_date}}</td>
                                    <td>{{ $materialsreturnbycustomer->reason_for_return}}</td>


                                     <td>
                                        <a href="{{ route('materialsreturnbycustomer.edit', $materialsreturnbycustomer->id) }}">
                                        <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('materialsreturnbycustomer.delete', $materialsreturnbycustomer->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </a>

                                        <a href="{{ route('materialsreturnbycustomer.view', $materialsreturnbycustomer->id) }}">
                                            <i class="mdi mdi-eye text-dark"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody> --}}

                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_materialsreturnbycustomer').DataTable();
        } );
    </script>
@endpush
