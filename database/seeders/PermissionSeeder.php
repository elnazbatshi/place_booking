<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();


        foreach (\App\Models\Permission::Permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach (\App\Models\Role::Roles as $role => $permissions) {
            $role = Role::create(['name' => $permissions]);
            $role->givePermissionTo($role);
        }


    }
}

