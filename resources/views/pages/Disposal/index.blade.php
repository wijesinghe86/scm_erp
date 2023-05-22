@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Disposal List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('disposal.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('disposal.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_disposal">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Disposal Document Number</td>
                                    {{-- <td>Managed By</td>
                                    <td>Inspected By</td> --}}
                                    <td>Stock Number</td>
                                    <td>Dispose Date</td>
                                    {{-- <td>Damage Quantity</td>
                                    <td>Product Value</td>
                                    <td>Reason for Dispose</td>
                                    <td>Mode of Dispose</td>
                                    <td>Disposal Document</td> --}}
                                    <td>Disposal Place</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($disposals as $disposal)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $disposal->disposal_document_number}}</td>
                                    <td>{{ $disposal->managed_by}}</td>
                                    <td>{{ $disposal->inspected_by}}</td>
                                    <td>{{ $disposal->stock_number}}</td>
                                    <td>{{ $disposal->dispose_date}}</td>
                                    <td>{{ $disposal->damage_quantity}}</td>
                                    <td>{{ $disposal->product_value}}</td>
                                    <td>{{ $disposal->reason_for_dispose}}</td>
                                    <td>{{ $disposal->mode_of_dispose}}</td>
                                    <td>{{ $disposal->disposal_document}}</td>
                                    <td>{{ $disposal->disposal_place}}</td>

                                    <td>
                                        <a href="{{ route('disposal.edit', $disposal->id) }}">
                                        <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('disposal.delete', $disposal->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </a>

                                        <a href="{{ route('disposal.view', $disposal->id) }}">
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
            $('#tbl_disposal').DataTable();
        } );
    </script>
@endpush
