<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Module;
use App\Models\Post;
use App\Models\TypeCategory;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\CategoryTypePolicy;
use App\Policies\MenuItemPolicy;
use App\Policies\MenuPolicy;
use App\Policies\ModulePolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class         => UserPolicy::class,
        Menu::class         => MenuPolicy::class,
        MenuItem::class     => MenuItemPolicy::class,
        TypeCategory::class => CategoryTypePolicy::class,
        Module::class       => ModulePolicy::class,
        Post::class         => PostPolicy::class,
        Role::class         => RolePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        });
    }
}
