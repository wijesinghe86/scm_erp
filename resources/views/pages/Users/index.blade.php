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
                        <table class="data-table table table-bordered">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{ $user->is_active == '1' ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td style="font-size: 18px;" >
                                        <a class="p-2" href="{{ route('users.indexUpdate', $user->id) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @if ($user->id != request()->user()->id)
                                            <a class="p-2" onclick="return confirmation();"
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
        $(document).ready(function() {
            $('.data-table').DataTable();
        });

        function confirmation() {
            if (!confirm("Are You Sure to delete this"))
                event.preventDefault();
        }
    </script>
@endpush
