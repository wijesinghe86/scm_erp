@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Password Change</h4>
                        <form method="POST" action="{{ route('users.passwordChange', request()->user()->id) }}">
                            @csrf
                            <div class="form-group col-md-4">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password"
                                    placeholder="Current Password">
                            </div>

                            <div class="form-group col-md-4">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password"
                                    placeholder="New Password">
                            </div>

                            <div class="form-group col-md-4">
                                <label>New Password Confirmation</label>
                                <input type="password" class="form-control" name="new_password_confirmation"
                                    placeholder="New Password Confirmation">
                            </div>
                            <button class="btn btn-success">Change Password</button>
                            <a href="/" style="margin-left: 20px;" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
