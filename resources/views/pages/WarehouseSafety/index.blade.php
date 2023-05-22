@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Storage Area</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('warehousesafety.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('warehousesafety.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_warehousesafety">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Exit Land </td>
                                <td>Entrance Land </td>
                                <td>Entrance Light</td>
                                {{-- <td>Exit Light</td>
                                <td>Excess Fan</td>
                                <td>Fire Hydrant</td>
                                <td>Fire Cylinder</td>
                                <td>Safety Warning</td>
                                <td>Danger Materials</td>
                                <td>Racking System</td>
                                <td>Fire trail</td>
                                <td>Fire Alarm</td>
                                <td>Electrical Issue</td> --}}
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($warehousesafetys as $warehousesafety)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $warehousesafety->exitland}}</td>
                            <td>{{ $warehousesafety->entranceland }}</td>
                            <td>{{ $warehousesafety->entrancelight}}</td>
                            <td>{{ $warehousesafety->exitlight }}</td>
                            <td>{{ $warehousesafety->excessfan }}</td>
                            <td>{{ $warehousesafety->firehydrant }}</td>
                            <td>{{ $warehousesafety->firecylinder }}</td>
                             <td>{{ $warehousesafety->safetywarning}}</td>
                            <td>{{ $warehousesafety->dangermaterials }}</td>
                            <td>{{ $warehousesafety->rackingsystem}}</td>
                            <td>{{ $warehousesafety->firetrail }}</td>
                            <td>{{ $warehousesafety->firealarm }}</td>
                            <td>{{ $warehousesafety->electricalissue }}</td>
                            <td>{{ $warehousesafety->createUser ? $warehousesafety->createUser->name : 'User not found' }}

                                <td>
                                    @if ($warehousesafety->warehousesafety_status == 1)
                                        <a href="{{ route('warehousesafety.deactive', $warehousesafety->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('warehousesafety.active', $warehousesafety->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('warehousesafety.view', $warehousesafety->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('warehousesafety.edit', $warehousesafety->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('warehousesafety.delete', $warehousesafety->id) }}">
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
            $('#tbl_warehousesafety').DataTable();
        } );
    </script>
@endpush
