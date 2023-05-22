@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Location Shelf Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationshelfdesign.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('locationshelfdesign.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id='tbl_locationshelfdesign'>

                        <thead>
                            <tr>
                                <td>No</td>
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
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationshelfdesigns as $locationshelfdesign)
                            <tr>
                                <td>{{$loop->iteration}}</td>
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
                            <td>{{ $locationshelfdesign->createUser ? $locationshelfdesign->createUser->name : 'User not found' }}</td>

                            <td>
                                @if ($locationshelfdesign->location_shelf_design_status == 1)
                                    <a href="{{ route('locationshelfdesign.deactive', $locationshelfdesign->id) }}"
                                        class="btn btn-primary btn-sm">Deactive</a>
                                @else
                                    <a href="{{ route('locationshelfdesign.active', $locationshelfdesign->id) }}"
                                        class="btn btn-success btn-sm">Active</a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('locationshelfdesign.view', $locationshelfdesign->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('locationshelfdesign.edit', $locationshelfdesign->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('locationshelfdesign.delete', $locationshelfdesign->id) }}">
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
            $('#tbl_locationshelfdesign').DataTable();
        } );
    </script>
@endpush
