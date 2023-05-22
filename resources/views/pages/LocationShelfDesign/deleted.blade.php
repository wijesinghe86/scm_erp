@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Location Shelf Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationshelfdesign.index') }}" class="btn btn-primary float-end mb-2"> Location Shelf Design List </a>
                        </div>
                        <table class="table table-bordered" id='tbl_locationshelfdesign'>

                        <thead>
                            <tr>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                {{-- <td>Row Number</td>
                                <td>Rack Number</td> --}}
                                <td>Shelf Number</td>
                                {{-- <td>Shelf Description</td>
                                <td>Shelf Height</td>
                                <td>Shelf Width</td>
                                <td>Shelf Length</td>
                                <td>Shelf Floor Area</td> --}}
                                <td>Deleted By</td>
                                <td>Deleted At</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationshelfdesigns as $locationshelfdesign)
                            <tr>
                            <td>{{ $locationshelfdesign->warehouse_code}}</td>
                            <td>{{ $locationshelfdesign->bay_number }}</td>
                            {{-- <td>{{ $locationshelfdesign->row_number }}</td>
                            <td>{{ $locationshelfdesign->rack_number }}</td> --}}
                            <td>{{ $locationshelfdesign->shelf_number }}</td>
                            {{-- <td>{{ $locationshelfdesign->shelf_description }}</td>
                            <td>{{ $locationshelfdesign->shelf_height}}</td>
                            <td>{{ $locationshelfdesign->shelf_width }}</td>
                            <td>{{ $locationshelfdesign->shelf_length }}</td>
                            <td>{{ $locationshelfdesign->shelf_floor_area }}</td> --}}
                            <td>{{ $locationshelfdesign->deleteUser ? $locationshelfdesign->deleteUser->name : 'User not found' }}</td>
                            <td>{{ $locationshelfdesign->deleted_at }}</td>

                            {{-- <td> <a href="{{ route('locationshelfdesign.restore', $locationshelfdesign->id) }}">
                                <i class="mdi mdi-pencil text-dark"></i></a>

                                <a href="{{ route('locationshelfdesign.delete.force', $locationshelfdesign->id) }}">
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
            $('#tbl_locationshelfdesign').DataTable();
        } );
    </script>
@endpush
