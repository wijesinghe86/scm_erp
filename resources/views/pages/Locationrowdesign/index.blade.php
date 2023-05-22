@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Location Row Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationrowdesign.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('locationrowdesign.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id='tbl_locationrowdesign'>

                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                <td>Row Number</td>
                                {{-- <td>Row Description</td>
                                <td>Row Height</td>
                                <td>Row Width</td>
                                <td>Row Length</td>
                                <td>Row Floor Area</td> --}}
                                <td>Created By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationrowdesigns as $locationrowdesign)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                            <td>{{ $locationrowdesign->warehouse_code}}</td>
                            <td>{{ $locationrowdesign->bay_number }}</td>
                            <td>{{ $locationrowdesign->row_number }}</td>
                            {{-- <td>{{ $locationrowdesign->row_description }}</td>
                            <td>{{ $locationrowdesign->row_height}}</td>
                            <td>{{ $locationrowdesign->row_width }}</td>
                            <td>{{ $locationrowdesign->row_length }}</td>
                            <td>{{ $locationrowdesign->row_floor_area }}</td> --}}
                            <td>{{ $locationrowdesign->createUser ? $locationrowdesign->createUser->name : 'User not found' }}</td>

                            <td>
                                @if ($locationrowdesign->locationrowdesign_status == 1)
                                    <a href="{{ route('locationrowdesign.deactive', $locationrowdesign->id) }}"
                                        class="btn btn-primary btn-sm">Deactive</a>
                                @else
                                    <a href="{{ route('locationrowdesign.active', $locationrowdesign->id) }}"
                                        class="btn btn-success btn-sm">Active</a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('locationrowdesign.view', $locationrowdesign->id) }}">
                                    <i class="fa-sharp fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('locationrowdesign.edit', $locationrowdesign->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('locationrowdesign.delete', $locationrowdesign->id) }}">
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
            $('#tbl_locationrowdesign').DataTable();
        } );
    </script>
@endpush
