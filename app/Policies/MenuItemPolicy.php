<?php

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;


    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::MANAGE_MENUEITEM);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::CREATE_MENUEITEM) || $user->hasPermissionTo(Permission::MANAGE_MENUEITEM);
    }

    public function update(User $user)
    {
        return
            $user->hasPermissionTo(Permission::UPDATE_MENUEITEM) || $user->hasPermissionTo(Permission::MANAGE_MENUEITEM);
    }


    public function delete(User $user)
    {
        return
            $user->hasPermissionTo(Permission::DELETE_MENUEITEM) || $user->hasPermissionTo(Permission::MANAGE_MENUEITEM);
    }

    public function view(User $user)
    {
        return
            $user->hasPermissionTo(Permission::CREATE_MENUEITEM) ||
            $user->hasPermissionTo(Permission::VIEW_MENUEITEM) ||
            $user->hasPermissionTo(Permission::UPDATE_MENUEITEM) ||
            $user->hasPermissionTo(Permission::DELETE_MENUEITEM) ||
            $user->hasPermissionTo(Permission::MANAGE_MENUEITEM);
    }
}
