<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize('view', User::class);
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.manage.user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $validation = $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'roles'    => ['required', 'array'],

        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole([$request->roles]);

        return response(['status' => (bool)$user, 'message' => 'کاربر با موفقیت اضافه شد']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', User::class);
        $validation = $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:users,email,' . $id],
            'password' => ['required', 'min:6'],
            'roles'    => ['required', 'array'],

        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole([$request->roles]);
        return response(['status' => (bool)$user, 'message' => 'کاربر با موفقیت اضافه شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        $status = User::destroy($id);
        return response(['status' => $status]);
    }
}
