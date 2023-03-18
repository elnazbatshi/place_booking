<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_MODULE);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_MODULE) || $user->hasPermissionTo(Permission::MANAGE_MODULE);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_MODULE) || $user->hasPermissionTo(Permission::MANAGE_MODULE);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_MODULE) || $user->hasPermissionTo(Permission::MANAGE_MODULE);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_MODULE) ||
            $user->hasPermissionTo(Permission::VIEW_MODULE) ||
            $user->hasPermissionTo(Permission::UPDATE_MODULE) ||
            $user->hasPermissionTo(Permission::DELETE_MODULE) ||
            $user->hasPermissionTo(Permission::MANAGE_MODULE);
    }


}
