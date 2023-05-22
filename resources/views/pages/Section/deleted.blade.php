@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Section List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('section.index') }}" class="btn btn-success float-end mb-2"> Section List </a>
                        </div>
                        <table class="table table-bordered" id="tbl_section">
                            <thead>
                                <tr>
                                    <td>Section Number</td>
                                    <td>Department Number</td>
                                    <td>Section Name</td>
                                    {{-- <td>Section Description</td>
                                    <td>Remark</td> --}}
                                    <td>Deleted By</td>
                                    <td>Deleted At</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $section->section_number}}</td>
                                    <td>{{ $section->department_number}}</td>
                                    <td>{{ $section->section_name}}</td>
                                    {{-- <td>{{ $section->section_description}}</td>
                                    <td>{{ $section->remark}}</td> --}}
                                    <td>{{ $section->deleteUser ? $section->deleteUser->name : 'User not found' }}</td>
                                    <td>{{ $section->deleted_at }}</td>
                                    {{-- <td>
                                        <a href="{{ route('section.restore', $section->id) }}">
                                            <i class="mdi mdi-pencil text-dark"></i></a>

                                        <a href="{{ route('section.delete.force', $section->id) }}">
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
            $('#tbl_section').DataTable();
        } );
    </script>
@endpush
