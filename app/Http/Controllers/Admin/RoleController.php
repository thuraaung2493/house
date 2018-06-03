<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    public function index()
    {
        return view('backend.roles.index');
    }

    public function getData()
    {
        $roles = Role::all();

        return Datatables::of($roles)
            ->addColumn('permissions', function ($role) {
                foreach ($role->permissions as $key => $value) {
                    $data[] = $key;
                }
                return $data;
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at ? with(new Carbon($role->created_at))->format('m/d/Y') : '';
            })
            ->addColumn('edit', function($role) {
                if (auth()->user()->hasAccess(['update-role'])) {
                    $data = '<a href="' . route('roles.edit', $role->id) . '" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                    return $data;
                }
            })
            ->addColumn('delete', function($role) {
                if (auth()->user()->hasAccess(['delete-role'])) {
                    $data = '<form action="' . route('roles.destroy', $role->id) . '" method="POST" onsubmit="return remove()">' . csrf_field() . method_field("DELETE") . ' <button class="btn btn-sm btn-danger" type="submit"><i class="glyphicon glyphicon-remove"></i> Delete</button></form>';
                    return $data;
                }
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
    }

    public function create()
    {
        if (auth()->user()->hasAccess(['create-role'])) {
            $permissions = config('permissions');
            return view('backend.roles.create', compact('permissions'));
        }
        alert()->warning("You are unautorize this action!", "Permission Denied");
        return view('errors.404');
    }

    public function store(RoleRequest $request)
    {
        Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => $request->permissions,
        ]);

        alert()->success('Successfully, a new role was created');
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = config('permissions');

        return view('backend.roles.edit', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => $request->permissions,
        ]);

        alert()->success("Update Successfully");

        return redirect()->route('roles.index');
    }
}
