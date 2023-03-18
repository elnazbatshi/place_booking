<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Helpers\NotificationHelper;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('admin.manage.permissions.index', compact('permissions', 'roles'));
    }

    public function getRoles()
    {
        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('admin.manage.roles.index', compact('permissions', 'roles'));
    }

    public function updateRole(Request $request, Role $role)
    {

        $request->validate([
            'role'          => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|integer'
        ]);

        $role->update([
            'name' => $request->role,
        ]);
        $status = $role->syncPermissions($request->permissions);

        return response(['status' => (bool)$status]);
    }

    public function deleteRole(Request $request, Role $role)
    {
        $role->syncPermissions('');
        $UserWithThisRole = User::role($role)->get();
        foreach ($UserWithThisRole as $admin) {
            $admin->removeRole($role->name);
        }
        $status = Role::destroy($role->id);
        return response(['status' => $status]);
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role'          => 'required|string|max:255|unique:roles,name',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'nullable|integer'
        ]);
        $role = Role::create([
            'name' => $request->role,
        ]);
        $status = $role->givePermissionTo($request->permissions);

        return response(['status' => (bool)$status]);
    }
}
