<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
// use Illuminate\Routing\Controllers\HasMiddleware;
// use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller
{

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:view users', only: ['index']),
    //         new Middleware('permission:edit user', only: ['edit']),
    //         // new Middleware('permission:create user', only: ['create']),
    //         // new Middleware('permission:delete users', only: ['destroy']),
    //     ];
    // }

    public function __construct()
    {
        $this->middleware('permission:view users')->only(['index']);
        $this->middleware('permission:edit user')->only(['edit']);
        $this->middleware('permission:create user')->only(['create']);
        // $this->middleware('permission:delete user')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = bcrypt('1234567890');
        $user->password = bcrypt($request->password);
        // $user->status = '1';
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success_message', "User Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id . 'id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)->withInput()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success_message', "User Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
