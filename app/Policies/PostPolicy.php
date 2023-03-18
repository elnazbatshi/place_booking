<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_POST);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_POST) || $user->hasPermissionTo(Permission::MANAGE_POST);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_POST) || $user->hasPermissionTo(Permission::MANAGE_POST);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_POST) || $user->hasPermissionTo(Permission::MANAGE_POST);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_POST) ||
            $user->hasPermissionTo(Permission::VIEW_POST) ||
            $user->hasPermissionTo(Permission::UPDATE_POST) ||
            $user->hasPermissionTo(Permission::DELETE_POST) ||
            $user->hasPermissionTo(Permission::MANAGE_POST);
    }

}
