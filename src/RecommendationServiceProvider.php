<?php

namespace Tsubasarcs\Recommendations;

use Illuminate\Support\ServiceProvider;

class RecommendationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/recommendation.php', 'recommendation');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__ . '/../config/recommendation.php' => config_path('recommendation.php'),
            ], 'config');
        }
    }
}
