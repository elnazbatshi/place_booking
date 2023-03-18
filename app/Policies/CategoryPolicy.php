<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_CATEGORY);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_CATEGORY) || $user->hasPermissionTo(Permission::MANAGE_CATEGORY);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_CATEGORY) || $user->hasPermissionTo(Permission::MANAGE_CATEGORY);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_CATEGORY) || $user->hasPermissionTo(Permission::MANAGE_CATEGORY);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_CATEGORY) ||
            $user->hasPermissionTo(Permission::VIEW_CATEGORY) ||
            $user->hasPermissionTo(Permission::UPDATE_CATEGORY) ||
            $user->hasPermissionTo(Permission::DELETE_CATEGORY) ||
            $user->hasPermissionTo(Permission::MANAGE_CATEGORY);
    }
}
