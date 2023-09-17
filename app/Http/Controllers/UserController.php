<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('pages.Users.index', compact('users'));
    }

    public function new()
    {
        $user = new User;
        $roleList = Role::get();
        $roles = [];

        return view('pages.Users.create', compact('user','roleList','roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'is_active' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->save();

        //TODO: get from request
        $user->assignRole(['deuser']);

        flash()->success('User Created');
        return redirect()->route('users.index');
    }


    public function indexUpdate(Request $request, User $user)
    {
        return view('pages.Users.update', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($request->email != $user->email) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'nullable',
            ]);
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
        ]);


        $user->name = $request->name;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->save();


        flash()->success('User Updated');
        return redirect()->route('users.index');
    }

    public function delete(Request $request, User $user)
    {
        $user->delete();
        flash()->success('User Removed');
        return redirect()->route('users.index');
    }

    public function passwordChangeIndex(Request $request, User $user)
    {
        return view('pages.Users.password-change', compact('user'));
    }

    public function passwordChange(Request $request, User $user)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:6|string'
        ]);

        if (!Hash::check($request->get('current_password'), request()->user()->password)) {
            throw ValidationException::withMessages(['password' => "Current Password is Invalid"]);
        }

        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            throw ValidationException::withMessages(['password' => "New Password cannot be same as your current password."]);
        }

        $user->password =  Hash::make($request->new_password);
        $user->save();
        flash()->success('User Password Changed');
        return redirect()->route('dashboard');
    }
}
