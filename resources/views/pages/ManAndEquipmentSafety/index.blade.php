@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Storage Area</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('manandequipmentsafety.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('manandequipmentsafety.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_manandequipmentsafety">
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
                            @foreach ($manandequipmentsafetys as $manandequipmentsafety)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $manandequipmentsafety->exitland}}</td>
                            <td>{{ $manandequipmentsafety->entranceland }}</td>
                            <td>{{ $manandequipmentsafety->entrancelight}}</td>
                            <td>{{ $manandequipmentsafety->exitlight }}</td>
                            <td>{{ $manandequipmentsafety->excessfan }}</td>
                            <td>{{ $manandequipmentsafety->firehydrant }}</td>
                            <td>{{ $manandequipmentsafety->firecylinder }}</td>
                             <td>{{ $manandequipmentsafety->safetywarning}}</td>
                            <td>{{ $manandequipmentsafety->dangermaterials }}</td>
                            <td>{{ $manandequipmentsafety->rackingsystem}}</td>
                            <td>{{ $manandequipmentsafety->firetrail }}</td>
                            <td>{{ $manandequipmentsafety->firealarm }}</td>
                            <td>{{ $manandequipmentsafety->electricalissue }}</td>
                            <td>{{ $manandequipmentsafety->createUser ? $manandequipmentsafety->createUser->name : 'User not found' }}

                                <td>
                                    @if ($manandequipmentsafety->manandequipmentsafety_status == 1)
                                        <a href="{{ route('manandequipmentsafety.deactive', $manandequipmentsafety->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('manandequipmentsafety.active', $manandequipmentsafety->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('manandequipmentsafety.view', $manandequipmentsafety->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('manandequipmentsafety.edit', $manandequipmentsafety->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('manandequipmentsafety.delete', $manandequipmentsafety->id) }}">
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
            $('#tbl_manandequipmentsafety').DataTable();
        } );
    </script>
@endpush
