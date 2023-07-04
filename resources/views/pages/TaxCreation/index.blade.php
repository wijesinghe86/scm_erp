@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Tax Creation List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('taxcreation.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('taxcreation.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                        </div>
                        <table class="table table-bordered" id="tbl_taxcreation">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Tax Code</td>
                                    <td>Tax Name</td>
                                    <td>Tax Rate</td>
                                    {{-- <td>Start Date</td>
                                    <td>Expire Date</td> --}}
                                    <td>Created By</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxcreations as $taxcreation)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $taxcreation->tax_code}}</td>
                                    <td>{{ $taxcreation->tax_name}}</td>
                                    <td>{{ $taxcreation->tax_rate}}</td>
                                    {{-- <td>{{ $taxcreation->start_date}}</td>
                                    <td>{{ $taxcreation->expire_date}}</td> --}}
                                    <td>{{ $taxcreation->createUser ? $taxcreation->createUser->name : 'User not found' }}</td>

                                    <td>
                                        @if ($taxcreation->tax_creation_status == 1)
                                            <a href="{{ route('taxcreation.deactive', $taxcreation->id) }}"
                                                class="btn btn-primary btn-sm">Deactive</a>
                                        @else
                                            <a href="{{ route('taxcreation.active', $taxcreation->id) }}"
                                                class="btn btn-success btn-sm">Active</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('taxcreation.view', $taxcreation->id) }}">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('taxcreation.edit', $taxcreation->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('taxcreation.delete', $taxcreation->id) }}">
                                            <i class="fa-solid fa-trash-can text-danger"></i>
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
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_taxcreation').DataTable();
        } );
    </script>
@endpush
