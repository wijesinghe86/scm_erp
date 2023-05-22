@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Equipment Maintenance</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('equipmentmaintenance.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('equipmentmaintenance.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_equipmentmaintenance">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Unit Load Carriers </td>
                                <td>Pallet Jacks </td>
                                <td>Lift Equipment</td>
                                {{-- <td>Pallet Racks</td>
                                <td>Ladders</td>
                                <td>Lights</td>
                                <td>Fan</td>
                                <td>Air Conditioner</td>
                                <td>Fire Alarm</td>
                                <td>Fire Hydrant</td>
                                <td>Vacuum Cleaner</td>
                                <td>Water Tap</td>--}}
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($equipmentmaintenances as $equipmentmaintenance)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $equipmentmaintenance->unit_load_carriers}}</td>
                            <td>{{ $equipmentmaintenance->pallet_jacks }}</td>
                            <td>{{ $equipmentmaintenance->lift_equipment}}</td>
                            <td>{{ $equipmentmaintenance->pallet_racks }}</td>
                            <td>{{ $equipmentmaintenance->ladders }}</td>
                            <td>{{ $equipmentmaintenance->lights }}</td>
                            <td>{{ $equipmentmaintenance->fan }}</td>
                            <td>{{ $equipmentmaintenance->air_conditioner}}</td>
                            <td>{{ $equipmentmaintenance->fire_alarm }}</td>
                            <td>{{ $equipmentmaintenance->fire_hydrant}}</td>
                            <td>{{ $equipmentmaintenance->vacuum_cleaner }}</td>
                            <td>{{ $equipmentmaintenance->water_tap }}</td>
                            <td>{{ $equipmentmaintenance->createUser ? $equipmentmaintenance->createUser->name : 'User not found' }}

                                <td>
                                    @if ($equipmentmaintenance->equipmentmaintenance_status == 1)
                                        <a href="{{ route('equipmentmaintenance.deactive', $equipmentmaintenance->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('equipmentmaintenance.active', $equipmentmaintenance->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('equipmentmaintenance.view', $equipmentmaintenance->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('equipmentmaintenance.edit', $equipmentmaintenance->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('equipmentmaintenance.delete', $equipmentmaintenance->id) }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
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
            $('#tbl_equipmentmaintenance').DataTable();
        } );
    </script>
@endpush
