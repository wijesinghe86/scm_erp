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
                                <input type="text" value="{{ old('name') }}"  class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="text" value="{{ old('email') }}"  class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Password</label>
                                <input type="password"  class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Active</label>
                                <select class="form-control" name="is_active">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
@endsection
