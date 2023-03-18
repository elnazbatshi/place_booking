<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;


    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_ROLE);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_ROLE) || $user->hasPermissionTo(Permission::MANAGE_ROLE);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_ROLE) || $user->hasPermissionTo(Permission::MANAGE_ROLE);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_ROLE) || $user->hasPermissionTo(Permission::MANAGE_ROLE);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_ROLE) ||
            $user->hasPermissionTo(Permission::VIEW_ROLE) ||
            $user->hasPermissionTo(Permission::UPDATE_ROLE) ||
            $user->hasPermissionTo(Permission::DELETE_ROLE) ||
            $user->hasPermissionTo(Permission::MANAGE_ROLE);
    }

}
