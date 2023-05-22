@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Plant Registration List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('PlantRegistration.index') }}" class="btn btn-primary float-end mb-2"> Plant Registration List </a>
                        </div>
                        <table class="table table-bordered" id="tbl_PlantRegistration">
                            <thead>
                            <tr>
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
                                <td>Deleted By</td>
                                <td>Deleted At</td>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($plantregistrations as $plantregistration)
                                <tr>
                                <!-- <td>{{ $plantregistration->stock_number}}</td> -->
                                <td>{{ $plantregistration->plant_number }}</td>
                                <td>{{ $plantregistration->plant_name }}</td>
                                <td>{{ $plantregistration->plant_type}}</td>
                                {{-- <td>{{ $plantregistration->plant_serial_number }}</td>
                                <td>{{ $plantregistration->model_number }}</td>
                                <td>{{ $plantregistration->manufactor_number }}</td>
                                <td>{{ $plantregistration->capacity}}</td>
                                <td>{{ $plantregistration->maintenance_period }}</td>
                                <td>{{ $plantregistration->electricalandelectronical_specification }}</td>
                                <td>{{ $plantregistration->electronic_specification}}</td>
                                <td>{{ $plantregistration->manual_operation_specification }}</td>
                                <td>{{ $plantregistration->maintaining_guide }}</td>
                                <td>{{ $plantregistration->operation_methods }}</td>
                                <td>{{ $plantregistration->analytical_manual}}</td>
                                <td>{{ $plantregistration->vendors_instruction_manual }}</td>
                                <td>{{ $plantregistration->safety_manual }}</td>
                                <td>{{ $plantregistration->purchase_date}}</td>
                                <td>{{ $plantregistration->po_number }}</td>
                                <td>{{ $plantregistration->asset_code }}</td>
                                <td>{{ $plantregistration->warehouse_code }}</td>
                                <td>{{ $plantregistration->condition }}</td>
                                <td>{{ $plantregistration->tag_number}}</td>
                                <td>{{ $plantregistration->size }}</td>
                                <td>{{ $plantregistration->weight }}</td>
                                <td>{{ $plantregistration->output }}</td> --}}
                                <td>{{ $plantregistration->deleteUser ? $plantregistration->deleteUser->name : 'User not found' }}</td>
                                <td>{{ $plantregistration->deleted_at }}</td>
                                {{-- <td>
                                    <a href="{{ route('plantregistration.restore', $plantregistration->id) }}">
                                         <i class="mdi mdi-pencil text-dark"></i></a>

                                    <a href="{{ route('plantregistration.delete.force', $plantregistration->id) }}">
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
            $('#tbl_PlantRegistration').DataTable();
        } );
    </script>
@endpush
