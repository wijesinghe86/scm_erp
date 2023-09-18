@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Creation</h4>
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                    placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="text" value="{{ old('email') }}" class="form-control" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Active</label>
                                <select class="form-control" name="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <hr class="hr" />
                            <div style="margin-bottom:1rem;">Roles</div>
                            <div style="margin-left:1.5rem;" class="form-group">
                                @foreach ($roleList as $role)
                                    <div class="form-check">
                                        <input class="form-check-input" id="{{ $role->id }}" type="checkbox"
                                            onchange="onRoleChange(this,{{ $role }})" />
                                        <label class="form-check-label"
                                            for="{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                                <input type="hidden" name="roles" id="roles" />
                            </div>
                            <button class="btn btn-success">Create</button>
                            <a href="{{ route('users.index') }}" style="margin-left: 20px;"
                                class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let roles = []

            function onRoleChange(e, roleData) {
                const role = roleData?.name
                if (roles.includes(role)) {
                    const indexOf = role.indexOf(role)
                    roles.splice(indexOf, 1)
                    if (roles.length == 0) {
                        $('#roles').val(null)
                    } else {
                        $('#roles').val(JSON.stringify(roles))
                    }
                    return
                }
                roles.push(role)
                $('#roles').val(JSON.stringify(roles))
            }
        </script>
    @endpush
@endsection
