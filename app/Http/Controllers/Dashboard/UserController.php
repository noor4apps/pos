<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }// end of index

    public function create()
    {
        return view('dashboard.users.create');
    }// end of create

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'permissions' => 'required',
        ]);

        $data = $request->except(['permissions[]']);
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.users.index')->with('success', __('site.added_successfully'));
    }// end of store

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }// end of edit

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'permissions' => 'required',
        ]);

        $data = $request->except(['permissions[]']);

        $user->update($data);

        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.users.index')->with('success', __('site.updated_successfully'));
    }// end of update

}// end of controller
