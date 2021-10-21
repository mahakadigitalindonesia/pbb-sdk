<?php


namespace Mdigi\PBB;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mdigi\PBB\Contracts\BangunanService;
use Mdigi\PBB\Contracts\KecamatanService;
use Mdigi\PBB\Contracts\KelurahanService;
use Mdigi\PBB\Contracts\LookupItemService;
use Mdigi\PBB\Contracts\ObjekPajakService;
use Mdigi\PBB\Contracts\PembayaranService;
use Mdigi\PBB\Contracts\WajibPajakService;
use Mdigi\PBB\Services\BangunanServiceImpl;
use Mdigi\PBB\Services\KecamatanServiceImpl;
use Mdigi\PBB\Services\KelurahanServiceImpl;
use Mdigi\PBB\Services\LookupItemServiceImpl;
use Mdigi\PBB\Services\ObjekPajakServiceImpl;
use Mdigi\PBB\Services\PembayaranServiceImpl;
use Mdigi\PBB\Services\WajibPajakServiceImpl;

class PBBServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'pbb');
        $this->registerServices();
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config('pbb.php'),
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

    protected function registerServices()
    {
        $this->app->bind(LookupItemService::class, LookupItemServiceImpl::class);
        $this->app->bind(KecamatanService::class, KecamatanServiceImpl::class);
        $this->app->bind(KelurahanService::class, KelurahanServiceImpl::class);
        $this->app->bind(ObjekPajakService::class, ObjekPajakServiceImpl::class);
        $this->app->bind(WajibPajakService::class, WajibPajakServiceImpl::class);
        $this->app->bind(BangunanService::class, BangunanServiceImpl::class);
        $this->app->bind(PembayaranService::class, PembayaranServiceImpl::class);
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