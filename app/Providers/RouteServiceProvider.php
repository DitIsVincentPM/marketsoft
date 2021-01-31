<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')->prefix('/')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
            Route::middleware('web')->prefix('/member')
                ->namespace($this->namespace)
                ->group(base_path('routes/auth.php'));
            Route::middleware('admin', 'web')->prefix('/admin')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));
            Route::middleware('web')->prefix('/team')
                ->namespace($this->namespace)
                ->group(base_path('routes/team.php'));
            Route::middleware('web')->prefix('/information')
                ->namespace($this->namespace)
                ->group(base_path('routes/information.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
    }
}
