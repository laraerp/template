<?php

namespace Laraerp\Providers;

use Illuminate\Support\ServiceProvider;

class TemplateServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $back = DIRECTORY_SEPARATOR . '..';
        $public = __DIR__ . $back . $back . DIRECTORY_SEPARATOR . 'public';

        $this->publishes([
            $public => public_path('vendor/laraerp/template'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        $this->app->register('Laraerp\Ordination\OrdinationServiceProvider');

        $this->app->booting(function()        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Order', 'Laraerp\Ordination\Facade');
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }

}
