<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    const SUPER_ADMIN = 'super admin';
    const USER = 'user';
    const USER_SITE = 'user-site';

    const Roles = [
        self::SUPER_ADMIN,
        self::USER,
        self::USER_SITE,
    ];

}
