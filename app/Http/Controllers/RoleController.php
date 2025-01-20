<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:view roles', only: ['index']),
    //         new Middleware('permission:edit role', only: ['edit']),
    //         new Middleware('permission:create role', only: ['create']),
    //         // new Middleware('permission:delete users', only: ['destroy']),
    //     ];
    // }

    public function __construct()
    {
        $this->middleware('permission:view roles')->only(['index']);
        $this->middleware('permission:edit role')->only(['edit']);
        $this->middleware('permission:create role')->only(['create']);
        // $this->middleware('permission:delete users')->only(['destroy']);
    }


    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.list', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|unique:roles|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }

        $role = Role::create([
            'name' => $request->name
        ]);

        if (!empty($request->permission)) {
            foreach ($request->permission as $name) {
                $role->givePermissionTo($name);
            }
        }

        return redirect()->route('roles.index')->with('success_message', 'Role Added Successfully');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::all();
        return view('admin.roles.edit', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            "name" => 'required|unique:roles,name,' . $id . ',id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create', $id)->withInput()->withErrors($validator);
        }

        $role->name = $request->name;
        $role->save();

        if (!empty($request->permission)) {
            $role->syncPermissions($request->permission);
        } else {
            $role->syncPermissions([]);
        }


        return redirect()->route('roles.index')->with('success_message', 'Role Updated Successfully');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success_message', 'Role deleted successfully.');
    }
}
