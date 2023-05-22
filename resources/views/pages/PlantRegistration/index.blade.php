@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Plant Registration List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('PlantRegistration.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('plantregistration.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                        </div>
                        <table class="table table-bordered" id="tbl_PlantRegistration">
                            <thead>
                            <tr>
                                <td>No</td>
                                <!-- <td>Stock Number</td> -->
                                <td>Plant Number</td>
                                <td>Plant Name</td>
                                <td>Plant Type</td>
                                {{-- <td>Plant Serial Number</td>
                                <td>Model Number</td>
                                <td>Manufactor Number</td>
                                <td>Capacity</td>
                                <td>Maintenance Period</td>
                                <td>Technical Specification</td>
                                <td>Electrical & Electronical Specification</td>
                                <td>Electronic Specification</td>
                                <td>Manual Operation Specification</td>
                                <td>Maintaining Guide</td>
                                <td>Operation Methods</td>
                                <td>Analytical Manual</td>
                                <td>Vendors Instruction Manual</td>
                                <td>Safety Manual</td>
                                <td>Purchase Date</td>
                                <td>Purchase Order Number</td>
                                <td>Asset Code</td>
                                <td>Warehouse Code</td>
                                <td>Condition</td>
                                <td>Tag Number</td>
                                <td>Size</td>
                                <td>Weight</td>
                                <td>Output</td> --}}
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($plantregistrations as $plantregistration)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                <td>{{ $plantregistration->plant_number }}</td>
                                <td>{{ $plantregistration->plant_name }}</td>
                                <td>{{ $plantregistration->plant_type}}</td>
                                {{-- <td>{{ $plantregistration->plant_serial_number }}</td>
                                <td>{{ $plantregistration->model_number }}</td>
                                <td>{{ $plantregistration->manufactor_number }}</td> --}}
                                <td>{{ $plantregistration->createUser ? $plantregistration->createUser->name : 'User not found' }}</td>

                                <td>
                                    @if ($plantregistration->plant_registration_status == 1)
                                        <a href="{{ route('plantregistration.deactive', $plantregistration->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('plantregistration.active', $plantregistration->id) }}"
                                            class="btn btn-success btn-sm">Active</a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('plantregistration.view', $plantregistration->id) }}">
                                        <i class="fa-sharp fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('plantregistration.edit', $plantregistration->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('plantregistration.delete', $plantregistration->id) }}">
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
            $('#tbl_PlantRegistration').DataTable();
        } );
    </script>
@endpush
