@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Location Bay Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationbaydesign.index') }}" class="btn btn-primary float-end mb-2"> Location Bay Design List </a>
                        </div>
                        <table class="table table-bordered" id='tbl_locationbaydesign'>

                        <thead>
                            <tr>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                <td>Bay Description</td>
                                <!-- <td>Bay Height</td>
                                <td>Bay Width</td>
                                <td>Bay Length</td> -->
                                <td>Bay Floor Area</td>
                                <td>Deleted By</td>
                                <td>Deleted At</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationbays as $location)
                            <tr>
                            <td>{{ $location->warehouse_code}}</td>
                            <td>{{ $location->bay_number }}</td>
                            <td>{{ $location->bay_description }}</td>
                            {{-- <td>{{ $location->bay_height}}</td>
                            <td>{{ $location->bay_width }}</td>
                            <td>{{ $location->bay_length }}</td> --}}
                            <td>{{ $location->bay_floor_area }}</td>
                            <td>{{ $location->deleteUser ? $location->deleteUser->name : 'User not found' }}</td>
                            <td>{{ $location->deleted_at }}</td>

                            {{-- <td><a href="{{ route('locationbaydesign.restore', $location->id) }}">
                                <i class="mdi mdi-pencil text-dark"></i></a>

                                <a href="{{ route('locationbaydesign.delete.force', $location->id) }}">
                                <i class="mdi mdi-delete text-danger"></i></a>
                            </td> --}}
                            </tr>
                            @endforeach
                        </tbody>

                        </table>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#tbl_locationbaydesign').DataTable();
        } );
    </script>
@endpush
