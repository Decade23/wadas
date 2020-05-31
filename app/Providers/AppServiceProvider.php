<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceContract;
use App\Services\Auth\Role\RoleService;
use App\Services\Auth\Role\RoleServiceContract;
use App\Services\Auth\User\UserService;
use App\Services\Auth\User\UserServiceContract;
use App\Services\Backend\Fulfillments\Posts\PostsService;
use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use App\Services\Backend\Product\ProductServices;
use App\Services\Backend\Product\ProductServicesContract;
use App\Services\Main\MainService;
use App\Services\Main\MainServiceContract;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthServiceContract::class,
            AuthService::class
        );

        $this->app->bind(
            UserServiceContract::class,
            UserService::class
        );

        $this->app->bind(
            MainServiceContract::class,
            MainService::class
        );

        $this->app->bind(
            RoleServiceContract::class,
            RoleService::class
        );

        $this->app->bind(
            PostsServiceContract::class,
            PostsService::class
        );

        $this->app->bind(
            ProductServicesContract::class,
            ProductServices::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
