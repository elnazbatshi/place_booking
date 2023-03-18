<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryTypePolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_TYPE_CATEGORY);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_TYPE_CATEGORY) || $user->hasPermissionTo(Permission::MANAGE_TYPE_CATEGORY);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_TYPE_CATEGORY) || $user->hasPermissionTo(Permission::MANAGE_TYPE_CATEGORY);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_TYPE_CATEGORY) || $user->hasPermissionTo(Permission::MANAGE_TYPE_CATEGORY);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_TYPE_CATEGORY) ||
            $user->hasPermissionTo(Permission::VIEW_TYPE_CATEGORY) ||
            $user->hasPermissionTo(Permission::UPDATE_TYPE_CATEGORY) ||
            $user->hasPermissionTo(Permission::DELETE_TYPE_CATEGORY) ||
            $user->hasPermissionTo(Permission::MANAGE_TYPE_CATEGORY);
    }
}
