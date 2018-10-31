<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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
        \Config::set('filesystems.disks.public.url', url('storage'));
        
        $this->mapApiRoutes();
        $this->mapUserRoutes();

        $this->mapWebRoutes();
        ////////Admin Routs/////////
        $this->mapAdminRoutes();
        ////////Admin Routs/////////

        //
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
        Route::middleware(['web','lang'])
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }
    /////////////////////Users Routs///////////////
    protected function mapUserRoutes()
    {
        Route::middleware(['web','lang'])
             ->namespace($this->namespace)
             ->group(base_path('routes/users.php'));
    }
    /////////////////////Users Routs///////////////
    
    /////////////////////Admin Routs///////////////
    protected function mapAdminRoutes()
    {
        Route::middleware(['web','lang'])
             ->namespace($this->namespace)
             ->group(base_path('routes/admin.php'));
    }
    /////////////////////Admin Routs///////////////

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
             ->middleware(['api','lang'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
