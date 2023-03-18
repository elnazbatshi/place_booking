<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    const SUPER_ADMIN = 'super admin';

    const MANAGE_USERS = 'manage users';
    const CREATE_USERS = 'create users';
    const VIEW_USERS = 'view users';
    const UPDATE_USERS = 'update users';
    const DELETE_USERS = 'delete users';

    const MANAGE_ROLE = 'manage role';
    const CREATE_ROLE = 'create role';
    const VIEW_ROLE = 'view role';
    const UPDATE_ROLE = 'update role';
    const DELETE_ROLE = 'delete role';


    const MANAGE_MENUE = 'manage menu';
    const CREATE_MENUE = 'create menu';
    const VIEW_MENUE = 'view menu';
    const UPDATE_MENUE = 'update menu';
    const DELETE_MENUE = 'delete menu';


    const MANAGE_MENUEITEM = 'manage menu item';
    const CREATE_MENUEITEM = 'create menu item';
    const VIEW_MENUEITEM = 'view menu item';
    const UPDATE_MENUEITEM = 'update menu item';
    const DELETE_MENUEITEM = 'delete menu item';

    const MANAGE_CATEGORY = 'manage category';
    const CREATE_CATEGORY = 'create category';
    const VIEW_CATEGORY = 'view category';
    const UPDATE_CATEGORY = 'update category';
    const DELETE_CATEGORY = 'delete category';


    const MANAGE_TYPE_CATEGORY = 'manage type category';
    const CREATE_TYPE_CATEGORY = 'create type category';
    const VIEW_TYPE_CATEGORY = 'view type category';
    const UPDATE_TYPE_CATEGORY = 'update type category';
    const DELETE_TYPE_CATEGORY = 'delete type category';


    const MANAGE_MODULE = 'manage module';
    const CREATE_MODULE = 'create module';
    const VIEW_MODULE = 'view module';
    const UPDATE_MODULE = 'update module';
    const DELETE_MODULE = 'delete module';

    const MANAGE_POST = 'manage post';
    const CREATE_POST = 'create post';
    const VIEW_POST = 'view post';
    const UPDATE_POST = 'update post';
    const DELETE_POST = 'delete post';

    const MANAGE_PERMISSION = 'manage permission';
    const CREATE_PERMISSION = 'create permission';
    const VIEW_PERMISSION = 'view permission';
    const UPDATE_PERMISSION = 'update permission';
    const DELETE_PERMISSION = 'delete permission';


    const VIEW_FILES = 'view files';

    const Permissions = [
        self::SUPER_ADMIN,

        self::MANAGE_USERS,
        self::CREATE_USERS,
        self::VIEW_USERS,
        self::UPDATE_USERS,
        self::DELETE_USERS,

        self::MANAGE_ROLE,
        self::CREATE_ROLE,
        self::VIEW_ROLE,
        self::UPDATE_ROLE,
        self::DELETE_ROLE,

        self::MANAGE_MENUE,
        self::CREATE_MENUE,
        self::VIEW_MENUE,
        self::UPDATE_MENUE,
        self::DELETE_MENUE,

        self::MANAGE_MENUEITEM,
        self::CREATE_MENUEITEM,
        self::VIEW_MENUEITEM,
        self::UPDATE_MENUEITEM,
        self::DELETE_MENUEITEM,


        self::MANAGE_CATEGORY,
        self::CREATE_CATEGORY,
        self::VIEW_CATEGORY,
        self::UPDATE_CATEGORY,
        self::DELETE_CATEGORY,

        self::MANAGE_TYPE_CATEGORY,
        self::CREATE_TYPE_CATEGORY,
        self::VIEW_TYPE_CATEGORY,
        self::UPDATE_TYPE_CATEGORY,
        self::DELETE_TYPE_CATEGORY,

        self::MANAGE_MODULE,
        self::CREATE_MODULE,
        self::VIEW_MODULE,
        self::UPDATE_MODULE,
        self::DELETE_MODULE,

        self::MANAGE_POST,
        self::CREATE_POST,
        self::VIEW_POST,
        self::UPDATE_POST,
        self::DELETE_POST,

        self::MANAGE_PERMISSION,
        self::CREATE_PERMISSION,
        self::VIEW_PERMISSION,
        self::UPDATE_PERMISSION,
        self::DELETE_PERMISSION,

        self::VIEW_FILES,

    ];

    const USER_PERMISSIONS = [
        self::MANAGE_USERS,
        self::CREATE_USERS,
        self::VIEW_USERS,
        self::UPDATE_USERS,
        self::DELETE_USERS,
    ];
    const MENU_PERMISSIONS = [
        self::MANAGE_MENUE,
        self::CREATE_MENUE,
        self::VIEW_MENUE,
        self::UPDATE_MENUE,
        self::DELETE_MENUE,
    ];

    const MENUITEM_PERMISSIONS = [
        self::MANAGE_MENUEITEM,
        self::CREATE_MENUEITEM,
        self::VIEW_MENUEITEM,
        self::UPDATE_MENUEITEM,
        self::DELETE_MENUEITEM,
    ];

    const CATEGORY_PERMISSIONS = [
        self::MANAGE_CATEGORY,
        self::CREATE_CATEGORY,
        self::VIEW_CATEGORY,
        self::UPDATE_CATEGORY,
        self::DELETE_CATEGORY,
    ];

    const TYPE_CATEGORY_PERMISSIONS = [
        self::MANAGE_TYPE_CATEGORY,
        self::CREATE_TYPE_CATEGORY,
        self::VIEW_TYPE_CATEGORY,
        self::UPDATE_TYPE_CATEGORY,
        self::DELETE_TYPE_CATEGORY,
    ];
    const MODULE_PERMISSIONS = [
        self::MANAGE_MODULE,
        self::CREATE_MODULE,
        self::VIEW_MODULE,
        self::UPDATE_MODULE,
        self::DELETE_MODULE,
    ];
    const POST_PERMISSIONS = [
        self::MANAGE_POST,
        self::CREATE_POST,
        self::VIEW_POST,
        self::UPDATE_POST,
        self::DELETE_POST,
    ];

    const ROLE_PERMISSIONS = [
        self::MANAGE_ROLE,
        self::CREATE_ROLE,
        self::VIEW_ROLE,
        self::UPDATE_ROLE,
        self::DELETE_ROLE,
    ];


}
