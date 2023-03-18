<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_USERS);
    }

    public function create(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_USERS) || $user->hasPermissionTo(Permission::MANAGE_USERS);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_USERS) || $user->hasPermissionTo(Permission::MANAGE_USERS);
    }

    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_USERS) || $user->hasPermissionTo(Permission::MANAGE_USERS);
    }

    public function view(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_USERS) ||
            $user->hasPermissionTo(Permission::VIEW_USERS) ||
            $user->hasPermissionTo(Permission::UPDATE_USERS) ||
            $user->hasPermissionTo(Permission::DELETE_USERS) ||
            $user->hasPermissionTo(Permission::MANAGE_USERS);
    }

}
