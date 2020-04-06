<?php

namespace Rjchauhan\LaravelFiner;

use Illuminate\Support\ServiceProvider;

class LaravelFinerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-finer');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-finer');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-finer.php', 'laravel-finer');

        // Register the service the package provides.
        /*$this->app->singleton('laravel-finer', function ($app) {
            return new LaravelFiner;
        });*/
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-finer'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-finer.php' => config_path('laravel-finer.php'),
        ], 'laravel-finer.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/laravel-finer'),
        ]);

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/laravel-finer'),
        ], 'laravel-finer.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-finer'),
        ], 'laravel-finer.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
