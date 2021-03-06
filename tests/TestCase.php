<?php

namespace Tsubasarcs\Recommendations\Tests;

use Exception;
use Orchestra\Testbench\TestCase as LaravelTestCase;

class TestCase extends LaravelTestCase
{
    /**
     * Setup the test environment.
     * @throws Exception
     */
    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__ . '/../migrations'),
        ]);

        $this->withFactories(__DIR__ . '/factories');

        $this->app['config']->set('recommendation.default.type', 1);
        $this->app['config']->set('recommendation.default.length', 10);
        $this->app['config']->set('recommendation.code_structure.prefix', '');
        $this->app['config']->set('recommendation.code_structure.timestamp', false);
        $this->app['config']->set('recommendation.code_structure.symbol', '-');
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Tsubasarcs\Recommendations\RecommendationServiceProvider::class,
            \Orchestra\Database\ConsoleServiceProvider::class,
        ];
    }
}