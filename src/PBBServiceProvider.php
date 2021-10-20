<?php


namespace Mdigi\PBB;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PBBServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'pbb');
        $this->mergeConfigFrom(__DIR__ . '/../config/oracle.php', 'pbb.database');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config('pbb.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../config/oracle.php' => config('pbb.database.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../database/migrations/CreateTable.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_table.php'),
            ], 'migrations');


            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/pbb'),
            ], 'views');

            $this->publishes([
                __DIR__ . '/../database/seeders/TableSeeder.php' => database_path('seeders/TableSeeder.php'),
            ], 'seeders');
        }

        $this->registerRoutes();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pbb');
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('pbb.routes.prefix'),
            'middleware' => config('pbb.routes.middleware'),
        ];
    }
}