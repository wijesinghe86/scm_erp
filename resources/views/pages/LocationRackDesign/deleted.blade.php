@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Location Rack Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationrackdesign.index') }}" class="btn btn-primary float-end mb-2"> Location Rack Design List </a>
                        </div>
                        <table class="table table-bordered" id='tbl_locationrackdesign'>

                        <thead>
                            <tr>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                <td>Row Number</td>
                                <td>Rack Number</td>
                                {{-- <td>Rack Description</td>
                                <td>Rack Height</td>
                                <td>Rack Width</td>
                                <td>Rack Length</td>
                                <td>Rack Floor Area</td> --}}
                                <td>Deleted By</td>
                                <td>Deleted At</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationrackdesigns as $locationrackdesign)
                            <tr>
                            <td>{{ $locationrackdesign->warehouse_code}}</td>
                            <td>{{ $locationrackdesign->bay_number }}</td>
                            <td>{{ $locationrackdesign->row_number }}</td>
                            <td>{{ $locationrackdesign->rack_number }}</td>
                            {{-- <td>{{ $locationrackdesign->rack_description }}</td>
                            <td>{{ $locationrackdesign->rack_height}}</td>
                            <td>{{ $locationrackdesign->rack_width }}</td>
                            <td>{{ $locationrackdesign->rack_length }}</td>
                            <td>{{ $locationrackdesign->rack_floor_area }}</td> --}}
                            <td>{{ $locationrackdesign->deleteUser ? $locationrackdesign->deleteUser->name : 'User not found' }}</td>
                            <td>{{ $locationrackdesign->deleted_at }}</td>

                            {{-- <td> <a href="{{ route('locationrackdesign.restore', $locationrackdesign->id) }}">
                            <i class="mdi mdi-pencil text-dark"></i></a>

                                <a href="{{ route('locationrackdesign.delete.force', $locationrackdesign->id) }}">
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
            $('#tbl_locationrackdesign').DataTable();
        } );
    </script>
@endpush
