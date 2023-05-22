@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Equipment Registration List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('equipmentregistration.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('equipmentregistration.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id="tbl_equipmentregistration">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Equipment Code</td>
                                    <td>Stock Number</td>
                                    <td>Equipment Name</td>
                                    {{-- <td>Equipment Description</td>
                                    <td>Equipment Type</td>
                                    <td>Condition</td>
                                    <td>Power Source</td>
                                    <td>Use By</td>
                                    <td>Super Voiced By</td> --}}
                                    <td>Created By</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipmentregistrations as $equipmentregistration)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $equipmentregistration->equipment_code}}</td>
                                    <td>{{ $equipmentregistration->stock_number}}</td>
                                    <td>{{ $equipmentregistration->equipment_name}}</td>
                                    {{-- <td>{{ $equipmentregistration->equipment_description}}</td>
                                    <td>{{ $equipmentregistration->equipment_type}}</td>
                                    <td>{{ $equipmentregistration->condition}}</td>
                                    <td>{{ $equipmentregistration->power_source}}</td>
                                    <td>{{ $equipmentregistration->useby}}</td>
                                    <td>{{ $equipmentregistration->supervoicedby}}</td> --}}
                                    <td>{{ $equipmentregistration->createUser ? $equipmentregistration->createUser->name : 'User not found' }}</td>

                                    <td>
                                        @if ($equipmentregistration->equipment_registration_status == 1)
                                            <a href="{{ route('equipmentregistration.deactive', $equipmentregistration->id) }}"
                                                class="btn btn-primary btn-sm">Deactive</a>
                                        @else
                                            <a href="{{ route('equipmentregistration.active', $equipmentregistration->id) }}"
                                                class="btn btn-success btn-sm">Active</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('equipmentregistration.view', $equipmentregistration->id) }}">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('equipmentregistration.edit', $equipmentregistration->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('equipmentregistration.delete', $equipmentregistration->id) }}">
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
            $('#tbl_equipmentregistration').DataTable();
        } );
    </script>
@endpush
