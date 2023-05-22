@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Warehouse Area Design</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('warehouseareadesign.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        {{-- <a href="{{ route('warehouseareadesign.deleted') }}" class="btn btn-success float-end mb-2"> Deleted </a> --}}
                    </div>
                        <table class="table table-bordered" id="tbl_warehouseareadesign">
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
                            @foreach ($warehouseareadesigns as $warehouseareadesign)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $warehouseareadesign->warehouse_code}}</td>
                            <td>{{ $warehouseareadesign->description }}</td>
                            <td>{{ $warehouseareadesign->warehouse_area}}</td>
                            <td>{{ $warehouseareadesign->warehouse_storage_capacity }}</td>
                            <td>{{ $warehouseareadesign->bay_area }}</td>
                            <td>{{ $warehouseareadesign->bay_number }}</td>
                            <td>{{ $warehouseareadesign->bay_area_description }}</td>
                            <td>{{ $warehouseareadesign->createUser ? $warehouseareadesign->createUser->name : 'User not found' }}

                                <td>
                                    @if ($warehouseareadesign->warehouseareadesign_status == 1)
                                        <a href="{{ route('warehouseareadesign.deactive', $warehouseareadesign->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('warehouseareadesign.active', $warehouseareadesign->id) }}"
                                            class="btn btn-primary btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('warehouseareadesign.view', $warehouseareadesign->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('warehouseareadesign.edit', $warehouseareadesign->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('warehouseareadesign.delete', $warehouseareadesign->id) }}">
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
            $('#tbl_warehouseareadesign').DataTable();
        } );
    </script>
@endpush
