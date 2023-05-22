@extends('layouts.app')

@section('content')
<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Warehouse Location List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('warehouse.index') }}" class="btn btn-primary float-end mb-2"> Warehouse list</a>
                        </div>
                        <table class="table table-bordered" id="tbl_warehouse">
                        <thead>
                            <tr>
                                <td>Warehouse Code</td>
                                <td>Warehouse Name</td>
                                {{-- <td>Warehouse Description</td>
                                <td>Warehouse Height</td>
                                <td>Warehouse Width</td>
                                <td>Warehouse Length</td> --}}
                                <td>Warehouse Floor Area</td>
                                <td>Deleted By</td>
                                <td>Deleted At</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouses as $warehouse)
                            <tr>
                            <td>{{ $warehouse->warehouse_code}}</td>
                            <td>{{ $warehouse->warehouse_name }}</td>
                            {{-- <td>{{ $warehouse->description }}</td>
                            <td>{{ $warehouse->warehouse_height}}</td>
                            <td>{{ $warehouse->warehouse_width }}</td>
                            <td>{{ $warehouse->warehouse_length }}</td> --}}
                            <td>{{ $warehouse->warehouse_floor_area }}</td>
                            <td>{{ $warehouse->deleteUser?$warehouse->deleteUser->name : 'User not found' }}</td>
                            <td>{{ $warehouse->deleted_at }}</td>
                            {{-- <td>
                                <a href="{{ route('warehouse.restore', $warehouse->id) }}">
                                <i class="mdi mdi-pencil text-dark"></i></a>

                                <a href="{{ route('warehouse.delete.force', $warehouse->id) }}">
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
        $(document).ready(function() {
            $('#tbl_customer').DataTable({
                "order": [
                    [0, "asc"]
                ],

                "lenghtMenu":[
                //     [10, 25, 50, -1],
                    [100, 150, 200, "All"]
                ],
            });
        });
    </script>
@endpush

{{-- @push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_warehouse').DataTable();
        } );
    </script>
@endpush --}}
