<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.users.user-all');
    }

    public function getData()
    {
        $users = User::all();

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('edit', function($user) {
                if (auth()->user()->hasAccess(['update-user'])) {
                    $data = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                    return $data;
                }
            })
            ->addColumn('delete', function($user) {
                if (auth()->user()->hasAccess(['delete-user'])) {
                    $data = '<form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                    return $data;
                }
            })
            ->addColumn('details', function($user) {
                return '<a href="' . route('profiles.show', $user->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
            })
            ->rawColumns(['edit','delete', 'details'])
            ->make(true);
    }

    public function superadmin()
    {
        return view('backend.users.superadmin');
    }

    public function superadminData()
    {
        $role = Role::where('slug', 'superadmin')->first();
        $users = $role->users;

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';
                })
                ->addColumn('edit', function($user) {
                    if (auth()->user()->hasAccess(['update-user'])) {
                        $data = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        return $data;
                    }
                })
                ->addColumn('delete', function($user) {
                    if (auth()->user()->hasAccess(['delete-user'])) {
                        $data = '<form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                        return $data;
                    }
                })
                ->addColumn('details', function($user) {
                    return '<a href="' . route('profiles.show', $user->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
                })
                ->rawColumns(['edit','delete', 'details'])
                ->make(true);
    }

    public function admin()
    {
        return view('backend.users.admin');
    }

    public function adminData()
    {
        $role = Role::where('slug', 'admin')->first();
        $users = $role->users;

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';
                })
                ->addColumn('edit', function($user) {
                    if (auth()->user()->hasAccess(['update-user'])) {
                        $data = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        return $data;
                    }
                })
                ->addColumn('delete', function($user) {
                    if (auth()->user()->hasAccess(['delete-user'])) {
                        $data = '<form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                        return $data;
                    }
                })
                ->addColumn('details', function($user) {
                    return '<a href="' . route('profiles.show', $user->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
                })
                ->rawColumns(['edit','delete', 'details'])
                ->make(true);
    }

    public function host()
    {
        return view('backend.users.host');
    }

    public function hostData()
    {
        $role = Role::where('slug', 'host')->first();
        $users = $role->users;

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';
                })
                ->addColumn('edit', function($user) {
                    if (auth()->user()->hasAccess(['update-user'])) {
                        $data = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        return $data;
                    }
                })
                ->addColumn('delete', function($user) {
                    if (auth()->user()->hasAccess(['delete-user'])) {
                        $data = '<form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                        return $data;
                    }
                })
                ->addColumn('details', function($user) {
                    return '<a href="' . route('profiles.show', $user->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
                })
                ->rawColumns(['edit','delete', 'details'])
                ->make(true);
    }

    public function vistor()
    {
        return view('backend.users.vistor');
    }

    public function vistorData()
    {
        $role = Role::where('slug', 'guest')->first();
        $users = $role->users;

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('m/d/Y') : '';
                })
                ->addColumn('edit', function($user) {
                    if (auth()->user()->hasAccess(['update-user'])) {
                        $data = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        return $data;
                    }
                })
                ->addColumn('delete', function($user) {
                    if (auth()->user()->hasAccess(['delete-user'])) {
                        $data = '<form action="' . route('users.destroy', $user->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                        return $data;
                    }
                })
                ->addColumn('details', function($user) {
                    return '<a href="' . route('profiles.show', $user->id) . '" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-option-horizontal"></i></a>';
                })
                ->rawColumns(['edit','delete', 'details'])
                ->make(true);
    }

    public function create()
    {
        $roles = Role::where('slug', '!=', 'superadmin')->get();
        return view('backend.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        // dd($request->all());
        // user create
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // profile create
        if ($request->hasFile('image')) {
            $profile_image = $request->image;
            $image_name = str_slug(auth()->user()->name, '-');
            $extension = $profile_image->getClientOriginalExtension();
            $profile_image->storeAs('public/photos/profiles', $image_name . '.' . $extension);
            $user->profile()->create([
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'image_name' => $image_name,
                'extension' => $extension,
            ]);
        } else {
            $user->profile()->create([
                'address' => $request->address,
                'phone_no' => $request->phone_no,
            ]);
        }

        // role create
        $role = Role::where('slug', $request->role)->first();
        $user->roles()->attach($role);

        return redirect()->route('profiles.show', $user->id);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRole = $user->roles()->first();
        // dd($role);

        return view('backend.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        // dd($request->all());
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->filled('new_password')) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->new_password),
                ]);
            }

            alert()->success('Update Successfully');
            return redirect()->route('users.index');
        }

        alert()->warning('Password is incorrect!');
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        if ($user->profile != null) {
            $user->profile->delete();
            $path = storage_path('app/public/photos/profiles/');
            $old_image_name = $user->profile->image_name .
                                $user->profile->extension;

            if (File::exists($path . $old_image_name)) {
                Storage::delete('/public/photos/profiles/' . $old_image_name);
            }
        }

        return back();
    }
}
