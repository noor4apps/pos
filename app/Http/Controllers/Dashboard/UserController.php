<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only(['index']);
        $this->middleware(['permission:create_users'])->only(['create', 'store']);
        $this->middleware(['permission:update_users'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_users'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });

        })->latest()->paginate(10);

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

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', __('site.deleted_successfully'));
    }

}// end of controller
