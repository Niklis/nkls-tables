<?php

namespace Nkls\Tables\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class NklsTablesServiceProvider extends ServiceProvider
{
    public function register()
    {
        //helpers
        require_once __DIR__ . '/../Helpers/helpers.php';

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(__DIR__ . '/../../config/nkls-tables.php', 'nkls-tables');
    }

    public function boot()
    {        
        Livewire::component('offline', \Nkls\Tables\Offline::class);
        
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'nkls');
        //bootstrap-5-3 assets
        $this->publishes([__DIR__ . '/../../assets/themes/bootstrap-5-3/css' => public_path('/css')], 'nkls-tables-bootstrap-5-3');
        $this->publishes([__DIR__ . '/../../assets/themes/bootstrap-5-3/js' => public_path('/js')], 'nkls-tables-bootstrap-5-3');
        $this->publishes([__DIR__ . '/../../assets/themes/bootstrap-5-3/fonts' => public_path('/css/fonts')], 'nkls-tables-bootstrap-5-3');
        //mdb-bootstrap assets
        $this->publishes([__DIR__ . '/../../assets/themes/mdb-bootstrap/css' => public_path('/css')], 'nkls-tables-mdb-bootstrap');
        $this->publishes([__DIR__ . '/../../assets/themes/mdb-bootstrap/js' => public_path('/js')], 'nkls-tables-mdb-bootstrap');
        $this->publishes([__DIR__ . '/../../assets/themes/mdb-bootstrap/fonts' => public_path('/css/fonts')], 'nkls-tables-mdb-bootstrap');
        //Views
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/nkls'),], 'nkls-tables-views');
        //Config
        $this->publishes([__DIR__ . '/../../config/nkls-tables.php' => config_path('nkls-tables.php')], 'nkls-tables-config');
    }
}
