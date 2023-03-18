<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_MENUE);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_MENUE) || $user->hasPermissionTo(Permission::MANAGE_MENUE);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_MENUE) || $user->hasPermissionTo(Permission::MANAGE_MENUE);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_MENUE) || $user->hasPermissionTo(Permission::MANAGE_MENUE);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_MENUE) ||
            $user->hasPermissionTo(Permission::VIEW_MENUE) ||
            $user->hasPermissionTo(Permission::UPDATE_MENUE) ||
            $user->hasPermissionTo(Permission::DELETE_MENUE) ||
            $user->hasPermissionTo(Permission::MANAGE_MENUE);
    }

}
