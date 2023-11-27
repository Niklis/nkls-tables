<?php

namespace Nkls\Tables;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;


class NklsTablesServiceProvider extends ServiceProvider
{
    public function register()
    {
        //helpers
        require_once __DIR__ . '/Helpers/helpers.php';

        // use vendor configuration file as fallback
        $this->mergeConfigFrom(__DIR__ . '/../config/nkls-tables.php', 'nkls-tables');
    }

    public function boot()
    {
        //config
        $this->publishes([__DIR__ . '/../config/nkls-tables.php' => config_path('nkls-tables.php')], 'config');
        //assets
        $this->publishes([__DIR__ . '/../assets/themes' => public_path('themes')], 'assets');
        // $this->publishes([__DIR__ . '/../assets/css' => public_path('css')], 'assets');
        // $this->publishes([__DIR__ . '/../assets/js' => public_path('js')], 'assets');

        $this->loadViewsFrom(__DIR__ . '/../resources/' . config('nkls-tables.theme') . '/views', 'nkls');

        $this->registerLivewireComponents();

        // Blade::anonymousComponentPath(__DIR__ . '/../resources/' . config('nkls-tables.theme') . '/views');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/' . config('nkls-tables.theme') . '/views');
       
    }

    /**
     * Register Livewire components
     */
    protected function registerLivewireComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            Livewire::component('users-table', \Nkls\Tables\Livewire\Users\UsersTable::class);
            Livewire::component('offline', \Nkls\Tables\Offline::class);
        });
    }
}
