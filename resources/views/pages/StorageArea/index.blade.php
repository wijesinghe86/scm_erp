@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Storage Area</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('storagearea.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('storagearea.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_storagearea">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Warehouse Code</td>
                                <td>Warehouse Description</td>
                                {{-- <td>Warehouse Area</td>
                                <td>Warehouse Storage Capacity</td>
                                <td>Bay Area</td>
                                <td>Bay Number</td>
                                <td>Bay Area Description</td> --}}
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach ($storageareas as $storagearea)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $storagearea->warehouse_code}}</td>
                            <td>{{ $storagearea->description }}</td>
                            <td>{{ $storagearea->warehouse_area}}</td>
                            <td>{{ $storagearea->warehouse_storage_capacity }}</td>
                            <td>{{ $storagearea->bay_area }}</td>
                            <td>{{ $storagearea->bay_number }}</td>
                            <td>{{ $storagearea->bay_area_description }}</td>
                            <td>{{ $storagearea->createUser ? $storagearea->createUser->name : 'User not found' }}

                                <td>
                                    @if ($storagearea->storagearea_status == 1)
                                        <a href="{{ route('storagearea.deactive', $storagearea->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('storagearea.active', $storagearea->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('storagearea.view', $storagearea->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('storagearea.edit', $storagearea->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('storagearea.delete', $storagearea->id) }}">
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
            $('#tbl_storagearea').DataTable();
        } );
    </script>
@endpush
