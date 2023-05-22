@extends('layouts.app')

@section('content')

<div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4>Location Row Design List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('locationrowdesign.index') }}" class="btn btn-primary float-end mb-2"> Location Row Design List </a>
                        </div>
                        <table class="table table-bordered" id='tbl_locationrowdesign'>

                        <thead>
                            <tr>
                                <td>Warehouse Code</td>
                                <td>Bay Number</td>
                                {{-- <td>Row Number</td> --}}
                                <td>Row Description</td>
                                {{-- <td>Row Height</td>
                                <td>Row Width</td>
                                <td>Row Length</td> --}}
                                <td>Row Floor Area</td>
                                <td>Deleted By</td>
                                <td>Deleted At</td>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($locationrowdesigns as $locationrowdesign)
                            <tr>
                            <td>{{ $locationrowdesign->warehouse_code}}</td>
                            <td>{{ $locationrowdesign->bay_number }}</td>
                            {{-- <td>{{ $locationrowdesign->row_number }}</td> --}}
                            <td>{{ $locationrowdesign->row_description }}</td>
                            {{-- <td>{{ $locationrowdesign->row_height}}</td>
                            <td>{{ $locationrowdesign->row_width }}</td>
                            <td>{{ $locationrowdesign->row_length }}</td> --}}
                            <td>{{ $locationrowdesign->row_floor_area }}</td>
                            <td>{{ $locationrowdesign->deleteUser ? $locationrowdesign->deleteUser->name : 'User not found' }}
                            <td>{{ $locationrowdesign->deleted_at }}</td>

                            {{-- <td> <a href="{{ route('locationrowdesign.restore', $locationrowdesign->id) }}">
                                <i class="mdi mdi-pencil text-dark"></i></a>

                                <a href="{{ route('locationrowdesign.delete.force', $locationrowdesign->id) }}">
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
            $('#tbl_locationrowdesign').DataTable();
        } );
    </script>
@endpush
