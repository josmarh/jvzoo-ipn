<?php

namespace Josmarh\JVZooIPN;

use Illuminate\Support\ServiceProvider;

class JVZooIPNServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(JVZooIPN::class, function ($app) {
            return new JVZooIPN();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/jvzoo-ipn.php' =>
            config_path('jvzoo-ipn.php'),
        ], 'jvzoo-ipn-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // $this->publishes([
        //     __DIR__.'/../database/migrations/' =>
        //     database_path('migrations'),
        // ], 'jvzoo-ipn-migrations');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}