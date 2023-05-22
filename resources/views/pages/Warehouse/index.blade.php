@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Warehouse Location List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('warehouse.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('warehouse.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id="tbl_warehouse">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Warehouse Code</td>
                                <td>Warehouse Name</td>
                                {{-- <td>Warehouse Description</td>
                                <td>Warehouse Height</td>
                                <td>Warehouse Width</td>
                                <td>Warehouse Length</td> --}}
                                <td>Warehouse Floor Area</td>
                                <td>Created By</td>
                                <td>Status</td>

                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouses as $warehouse)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $warehouse->warehouse_code}}</td>
                            <td>{{ $warehouse->warehouse_name }}</td>
                            {{-- <td>{{ $warehouse->description }}</td>
                            <td>{{ $warehouse->warehouse_height}}</td>
                            <td>{{ $warehouse->warehouse_width }}</td>
                            <td>{{ $warehouse->warehouse_length }}</td> --}}
                            <td>{{ $warehouse->warehouse_floor_area }}</td>
                            <td>{{ $warehouse->createUser ? $warehouse->createUser->name : 'User not found' }}

                                <td>
                                    @if ($warehouse->warehouse_status == 1)
                                        <a href="{{ route('warehouse.deactive', $warehouse->id) }}"
                                            class="btn btn-primary btn-sm">Deactive</a>
                                    @else
                                        <a href="{{ route('warehouse.active', $warehouse->id) }}"
                                            class="btn btn-success btn-sm">Active</a>
                                    @endif
                                </td>

                            <td>
                                <a href="{{ route('warehouse.view', $warehouse->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('warehouse.edit', $warehouse->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('warehouse.delete', $warehouse->id) }}">
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
            $('#tbl_warehouse').DataTable();
        } );
    </script>
@endpush

@push('scripts')
    <script>
        // $(document).ready(function() {
        //     $('#tbl_customer').DataTable({
        //         "order": [
        //             [0, "asc"]
        //         ],

        //         "lenghtMenu":[
        //         //     [10, 25, 50, -1],
        //             [100, 150, 200, "All"]
        //         ],
        //     });
        // });
    </script>
@endpush
