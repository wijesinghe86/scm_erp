@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4><a href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i></a>User List</h4>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('users.new') }}" class="btn btn-success float-end mb-2">Add New </a>
                        </div>
                        <table class="table table-bordered" id="tbl_warehouse">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.indexUpdate', $user->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @if ($user->id != request()->user()->id)
                                            <a onclick="return confirmation();"
                                                href="{{ route('users.delete', $user->id) }}">
                                                <i class="fa-solid fa-trash-can text-danger"></i>
                                            </a>
                                        @endif

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
        function confirmation() {
            if (!confirm("Are You Sure to delete this"))
                event.preventDefault();
        }
    </script>
@endpush
