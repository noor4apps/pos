<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only(['index']);
        $this->middleware(['permission:create_users'])->only(['create', 'store']);
        $this->middleware(['permission:update_users'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_users'])->only(['destroy']);
    }// end of construct

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
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp|max:10240',
            'permissions' => 'required|array|min:1',
        ]);

        $data = $request->except(['permissions[]', 'image']);
        $data['password'] = bcrypt($request->password);

        if($request->image) {
            $name = $request->image->hashName();
            Image::make($request->image)->resize('225', null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $name));
            $data['image'] = $name;
        }

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
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp|max:10240',
            'permissions' => 'required|array|min:1',
        ]);

        $data = $request->except(['permissions[]', 'image']);

        if($request->has('image')) {
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            } // end of if

            $name = $request->image->hashName();
            Image::make($request->image)->resize('225', null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $name));
            $data['image'] = $name;
        }

        $user->update($data);

        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.users.index')->with('success', __('site.updated_successfully'));
    }// end of update

    public function destroy(User $user)
    {
        if($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        } // end of if

        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', __('site.deleted_successfully'));
    }// end of destroy

}// end of controller
