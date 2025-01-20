<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;


class PermissionController extends Controller
{
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:view permissions', only: ['index']),
    //         new Middleware('permission:edit permission', only: ['edit']),
    //         new Middleware('permission:create permission', only: ['create']),
    //         // new Middleware('permission:delete users', only: ['destroy']),
    //     ];
    // }

    public function __construct()
    {
        $this->middleware('permission:view permissions')->only(['index']);
        $this->middleware('permission:edit permission')->only(['edit']);
        $this->middleware('permission:create permission')->only(['create']);
        // $this->middleware('permission:delete permission')->only(['destroy']);
    }


    public function index()
    {
        $permissions = Permission::all();
        // return $permissions;
        return view('admin.permission.list', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }

        Permission::create(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success_message', 'Permission Updated Successfully.');

        // if ($request->isMethod('post')) {
        //     Permission::create([
        //         'name' => $request->name,
        //     ]);
        //     return redirect()->route('permissions.index')->with('success_message', "Permission Added Successfully");
        // }

        return redirect()->route('permissions.create');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update($id, Request $request)
    {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }

        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success_message', 'Permission Updated Successfully.');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success_message', 'Permission deleted successfully.');
    }
}
