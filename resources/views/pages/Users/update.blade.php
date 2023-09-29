@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Update</h4>
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input type="text" required class="form-control" name="name"
                                    value="{{ $user->name }}" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="text" required class="form-control" name="email"
                                    value="{{ $user->email }}" placeholder="Email">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <p><small>*** Leave Empty if you dont want to change ***</small></p>
                            </div>
                            @if ($user->id != request()->user()->id)
                                <div class="form-group col-md-4">
                                    <label>Active</label>
                                    <select value="{{ $user->is_active }}" class="form-control" name="is_active">
                                        <option {{ $user->is_active == '1' ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $user->is_active == '0' ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                            @endif
                            <hr class="hr" />
                            <div style="margin-bottom:1rem;">Roles</div>
                            <div style="margin-left:1.5rem;" class="form-group">
                                @foreach ($roleList as $role)
                                    <div class="form-check">
                                        <input
                                            {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'checked' : '' }}
                                            class="form-check-input" id="{{ $role->id }}" type="checkbox"
                                            onchange="onRoleChange(this,{{ $role }})" />
                                        <label class="form-check-label"
                                            for="{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                                <input type="hidden" name="roles" id="roles" />
                            </div>
                            <button class="btn btn-success">Update</button>
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
            $(document).ready(function() {
                let userRoles = <?php echo $user->roles->pluck('name'); ?>;
                $('#roles').val(JSON.stringify(userRoles))
                roles = userRoles
            });


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
