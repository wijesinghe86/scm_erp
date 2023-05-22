@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Tax Creation List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('taxcreation.index') }}" class="btn btn-success float-end mb-2"> Tax Creation List </a>
                        </div>
                        <table class="table table-bordered" id="tbl_taxcreation">
                            <thead>
                                <tr>
                                    <td>Tax Code</td>
                                    <td>Tax Name</td>
                                    <td>Tax Description</td>
                                    {{-- <td>Start Date</td>
                                    <td>Expire Date</td> --}}
                                    <td>Deleted By</td>
                                    <td>Deleted At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxcreations as $taxcreation)
                                <tr>
                                    <td>{{ $taxcreation->tax_code}}</td>
                                    <td>{{ $taxcreation->tax_name}}</td>
                                    <td>{{ $taxcreation->tax_description}}</td>
                                    {{-- <td>{{ $taxcreation->start_date}}</td>
                                    <td>{{ $taxcreation->expire_date}}</td> --}}
                                    <td>{{ $taxcreation->deleteUser ? $taxcreation->deleteUser->name : 'User not found' }}</td>
                                    <td>{{ $taxcreation->deleted_at }}</td>
                                    {{-- <td>
                                        <a href="{{ route('taxcreation.restore', $taxcreation->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('taxcreation.delete.force', $taxcreation->id) }}">
                                            <i class="mdi mdi-delete text-danger"></i></a>
                                    </td> --}}
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
        $(document).ready( function () {
            $('#tbl_taxcreation').DataTable();
        } );
    </script>
@endpush
