@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Fleet Registration List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('fleetregistration.index') }}" class="btn btn-primary float-end mb-2"> Fleet Registration List </a>
                    </div>
                        <table class="table table-bordered" id="tbl_fleetregistration">
                            <thead>
                                <tr>
                                    <td>Fleet Number</td>
                                    <td>Fleet Name</td>
                                    <td>Fleet Registration Number</td>
                                    {{-- <td>Current Owner</td>
                                    <td>Category Of Fleet</td>
                                    <td>Current Meter Reading</td>
                                    <td>Type Of Fuel Consumption</td>
                                    <td>Loading Capacity</td>
                                    <td>Fleet Type</td>
                                    <td>Make</td>
                                    <td>Model</td>
                                    <td>Fleet Manufacture Year</td>
                                    <td>Engine Capacity</td>
                                    <td>Engine Number</td>
                                    <td>Chassis Number</td>
                                    <td>Colour</td>
                                    <td>Tax Period From</td>
                                    <td>Tax Period To</td>
                                    <td>Paid Amount</td>
                                    <td>Insured Company</td>
                                    <td>Period</td>
                                    <td>Insurance Start Date</td>
                                    <td>Insurance Expire Date</td>
                                    <td>Insurance Policy</td>
                                    <td>Amount/td> --}}
                                    <td>Deleted By</td>
                                    <td>Deleted At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fleetregistrations as $fleetregistration)
                                <tr>
                                    <td>{{ $fleetregistration->fleet_number}}</td>
                                    <td>{{ $fleetregistration->fleet_name }}</td>
                                    <td>{{ $fleetregistration->fleet_registration_number }}</td>
                                    {{-- <td>{{ $fleetregistration->current_owner}}</td>
                                    <td>{{ $fleetregistration->category_of_fleet }}</td>
                                    <td>{{ $fleetregistration->current_meter_reading }}</td>
                                    <td>{{ $fleetregistration->type_of_fuel_consumption}}</td>
                                    <td>{{ $fleetregistration->loading_capacity }}</td>
                                    <td>{{ $fleetregistration->fleet_type }}</td>
                                    <td>{{ $fleetregistration->make}}</td>
                                    <td>{{ $fleetregistration->model }}</td>
                                    <td>{{ $fleetregistration->fleet_manufacture_year }}</td>
                                    <td>{{ $fleetregistration->engine_capacity}}</td>
                                    <td>{{ $fleetregistration->engine_number }}</td>
                                    <td>{{ $fleetregistration->chassis_number }}</td>
                                    <td>{{ $fleetregistration->colour}}</td>
                                    <td>{{ $fleetregistration->tax_period_from }}</td>
                                    <td>{{ $fleetregistration->tax_period_to }}</td>
                                    <td>{{ $fleetregistration->paid_amount}}</td>
                                    <td>{{ $fleetregistration->insured_company }}</td>
                                    <td>{{ $fleetregistration->period }}</td>
                                    <td>{{ $fleetregistration->insurance_start_date }}</td>
                                    <td>{{ $fleetregistration->insurance_expire_date}}</td>
                                    <td>{{ $fleetregistration->insurance_policy }}</td>
                                    <td>{{ $fleetregistration->amount }}</td> --}}
                                    <td>{{ $fleetregistration->deleteUser?$fleetregistration->deleteUser->name : 'User not found' }}</td>
                                    <td>{{ $fleetregistration->deleted_at }}</td>

                                    {{-- <td>
                                        <a href="{{ route('fleetregistration.restore', $fleetregistration->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i>
                                        </a>

                                        <a href="{{ route('fleetregistration.delete.force', $fleetregistration->id) }}">
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
            $('#tbl_fleetregistration').DataTable();
        } );
    </script>
@endpush
