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

        $this->app->bind(CodeService::class, function () {
            return new CodeService;
        });
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
                __DIR__ . '/../migrations/2019_04_23_074703_create_recommendations_table.php' => database_path('migrations/2019_04_23_074703_create_recommendations_table.php'),
            ], 'migrations');

            $this->publishes([
                __DIR__ . '/../config/recommendation.php' => config_path('recommendation.php'),
            ], 'config');
        }
    }
}
