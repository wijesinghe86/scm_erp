@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Location Bay Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationbaydesign.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('locationbaydesign.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id='tbl_locationbaydesign'>

                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                {{-- <td>Bay Description</td>
                                <<td>Bay Height</td>
                                <td>Bay Width</td>
                                <td>Bay Length</td> --}}
                                <td>Bay Floor Area</td>
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationbays as $location)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                        <td>{{ $location->warehouse_code}}</td>
                            <td>{{ $location->bay_number }}</td>
                            {{-- <td>{{ $location->bay_description }}</td>
                            <td>{{ $location->bay_height}}</td>
                            <td>{{ $location->bay_width }}</td>
                            <td>{{ $location->bay_length }}</td> --}}
                            <td>{{ $location->bay_floor_area }}</td>
                            <td>{{ $location->createUser ? $location->createUser->name : 'User not found' }}</td>

                            <td>
                                @if ($location->locationbaydesign_status == 1)
                                    <a href="{{ route('locationbaydesign.deactive', $location->id) }}"
                                        class="btn btn-primary btn-sm">Deactive</a>
                                @else
                                    <a href="{{ route('locationbaydesign.active', $location->id) }}"
                                        class="btn btn-success btn-sm">Active</a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('locationbaydesign.view', $location->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('locationbaydesign.edit', $location->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('locationbaydesign.delete', $location->id) }}">
                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                </a>


                            </td>
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
