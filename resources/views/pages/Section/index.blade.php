@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4><a href="{{ route('dashboard') }}" ><i class="mdi mdi-home"></i></a>Section List</h2>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('section.create') }}" class="btn btn-success float-end mb-2"> Add New </a>
                        <a href="{{ route('section.deleted') }}" class="btn btn-danger float-end mb-2"> Delete </a>
                    </div>
                        <table class="table table-bordered" id="tbl_section">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Section Number</td>
                                    <td>Department Number</td>
                                    <td>Section Name</td>
                                    {{-- <td>Section Description</td>
                                    <td>Remarks</td> --}}
                                    <td>Created By</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $section->section_number}}</td>
                                    <td>{{ $section->department_number}}</td>
                                    <td>{{ $section->section_name}}</td>
                                    {{-- <td>{{ $section->section_description}}</td>
                                    <td>{{ $section->remark}}</td> --}}
                                    <td>{{ $section->createUser ? $section->createUser->name : 'User not found' }}</td>

                                    <td>
                                        @if ($section->section_status == 1)
                                            <a href="{{ route('section.deactive', $section->id) }}"
                                                class="btn btn-primary btn-sm">Deactive</a>
                                        @else
                                            <a href="{{ route('section.active', $section->id) }}"
                                                class="btn btn-success btn-sm">Active</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('section.view', $section->id) }}">
                                            <i class="fa-sharp fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('section.edit', $section->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('section.delete', $section->id) }}">
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
            $('#tbl_section').DataTable();
        } );
    </script>
@endpush
