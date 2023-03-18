<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function (User $user) {
            return $user->hasRole(Role::SUPER_ADMIN) ? true : null;
        });
        view()->composer('booking.layouts.footer', function (View $view) {
            $view->with('footers', Menu::where('name', 'footer')->where('status', 1)->withWhereHas('MenuItem', function ($query) {
                $query->where('parent_id', NULL)->where('status', 1)->with('children');
            })->first());
        });
        view()->composer('booking.layouts.footer', function (View $view) {
            $view->with('socials', Setting::where('type', 'social')->get());
        });

        view()->composer('booking.layouts.header', function (View $view) {
            $view->with('menuHeader', Menu::query()
                                          ->withWhereHas('MenuItem', function ($builder) {
                                              $builder->with('children')->where('status', 1)->whereNull('parent_id');
                                          })->where('name', 'header')->where('status', 1)->first());

        });


    }
}
