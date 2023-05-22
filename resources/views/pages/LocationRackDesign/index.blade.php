@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Location Rack Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationrackdesign.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('locationrackdesign.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id='tbl_locationrackdesign'>

                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                {{-- <td>Row Number</td> --}}
                                <td>Rack Number</td>
                                {{-- <td>Rack Description</td>
                                <td>Rack Height</td>
                                <td>Rack Width</td>
                                <td>Rack Length</td>
                                <td>Rack Floor Area</td>  --}}
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationrackdesigns as $locationrackdesign)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $locationrackdesign->warehouse_code}}</td>
                            <td>{{ $locationrackdesign->bay_number }}</td>
                            {{-- <td>{{ $locationrackdesign->row_number }}</td> --}}
                            <td>{{ $locationrackdesign->rack_number }}</td>
                            {{-- <td>{{ $locationrackdesign->rack_description }}</td>
                            <td>{{ $locationrackdesign->rack_height}}</td>
                            <td>{{ $locationrackdesign->rack_width }}</td>
                            <td>{{ $locationrackdesign->rack_length }}</td>
                            <td>{{ $locationrackdesign->rack_floor_area }}</td> --}}
                            <td>{{ $locationrackdesign->createUser ? $locationrackdesign->createUser->name : 'User not found' }}</td>

                            <td>
                                @if ($locationrackdesign->location_rack_design_status == 1)
                                    <a href="{{ route('locationrackdesign.deactive', $locationrackdesign->id) }}"
                                        class="btn btn-primary btn-sm">Deactive</a>
                                @else
                                    <a href="{{ route('locationrackdesign.active', $locationrackdesign->id) }}"
                                        class="btn btn-success btn-sm">Active</a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('locationrackdesign.view', $locationrackdesign->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('locationrackdesign.edit', $locationrackdesign->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('locationrackdesign.delete', $locationrackdesign->id) }}">
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
            $('#tbl_locationrackdesign').DataTable();
        } );
    </script>
@endpush
