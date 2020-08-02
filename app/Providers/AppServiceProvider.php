<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceContract;
use App\Services\Auth\Role\RoleService;
use App\Services\Auth\Role\RoleServiceContract;
use App\Services\Auth\User\UserService;
use App\Services\Auth\User\UserServiceContract;
use App\Services\Backend\Apl\Email\AplEmailService;
use App\Services\Backend\Apl\Email\AplEmailServiceContract;
use App\Services\Backend\Config\Email\EmailService;
use App\Services\Backend\Config\Email\EmailServiceContract;
use App\Services\Backend\Fulfillments\Posts\PostsService;
use App\Services\Backend\Fulfillments\Posts\PostsServiceContract;
use App\Services\Backend\Groups\GroupServices;
use App\Services\Backend\Groups\GroupServicesContract;
use App\Services\Backend\Map\MapServices;
use App\Services\Backend\Map\MapServicesContract;
use App\Services\Backend\Media\MediaServices;
use App\Services\Backend\Media\MediaServicesContract;
use App\Services\Backend\Member\MemberServices;
use App\Services\Backend\Member\MemberServicesContract;
use App\Services\Backend\Products\Product\ProductServices;
use App\Services\Backend\Products\Product\ProductServicesContract;
use App\Services\Backend\Products\ProductGroup\ProductGroupServices;
use App\Services\Backend\Products\ProductGroup\ProductGroupServicesContract;
use App\Services\Backend\Sales\SalesService;
use App\Services\Backend\Sales\SalesServiceContract;
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

        $this->app->bind(
            ProductGroupServicesContract::class,
            ProductGroupServices::class
        );

        $this->app->bind(
            GroupServicesContract::class,
            GroupServices::class
        );

        $this->app->bind(
            MediaServicesContract::class,
            MediaServices::class
        );

        $this->app->bind(
            SalesServiceContract::class,
            SalesService::class
        );

        $this->app->bind(
            MapServicesContract::class,
            MapServices::class
        );

        $this->app->bind(
            MemberServicesContract::class,
            MemberServices::class
        );

        $this->app->bind(
            EmailServiceContract::class,
            EmailService::class
        );

        $this->app->bind(
            AplEmailServiceContract::class,
            AplEmailService::class
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
