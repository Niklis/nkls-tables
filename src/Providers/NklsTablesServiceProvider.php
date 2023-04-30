<?php

namespace Nkls\Tables\Providers;

use Illuminate\Support\ServiceProvider;

class NklsTablesServiceProvider extends ServiceProvider
{
    public function register()
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/nkls-tables.php',
            'nkls-tables'
        );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'nkls');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/nkls'),
        ], 'nkls-tables-views');

        $this->publishes([
            __DIR__ . '/../../config/nkls-tables.php' => config_path('nkls-tables.php')
        ], 'nkls-tables-config');
    }
}
