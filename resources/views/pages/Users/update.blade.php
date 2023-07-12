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
                            <button class="btn btn-success">Update</button>
                            <a href="{{ route('users.index') }}" style="margin-left: 20px;"
                                class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
