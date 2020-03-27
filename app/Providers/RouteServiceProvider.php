<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        # Register Map BackEnd And FrontEnd Routes
        $this->mapFrontEndRoutes();
        $this->mapBackEndRoutes();

        # Route To Auth Console
        $this->mapAuthRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the route frontend
     */
    protected function mapFrontEndRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace. '\Frontend')
            ->group(base_path('routes/frontend/index.php'));
    }

    /**
     * Define the route backend
     */
    protected function mapBackEndRoutes()
    {
        Route::middleware('web', 'sentinel.permission:dashboard')
            ->namespace($this->namespace. '\Backend')
            ->group(base_path('routes/backend/index.php'));
    }

    protected function mapAuthRoutes()
    {
        Route::middleware('web')
            ->prefix('console')
            ->namespace($this->namespace. '\Auth')
            ->group(base_path('routes/auth/index.php'));
    }
}
