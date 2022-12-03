<?php
namespace laravelTideways;
use Closure;
use Fruitcake\Cors\HandleCors;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\ServiceProvider;
use laravelTideways\facade\Tideways;

class TidewaysServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("tidewaysHandler",function($app){
            $config = $app->make('config')->get('tideways.connection.mongodb');
            $host = $config['host'];
            $db = $config['db'];
            $options = array_filter($config['options']);
            $mongoClient = new \MongoClient($host,$options);
            $mongoClient->$db->results->findOne();
            $profiles = new Profiles($mongoClient->$db);
            return new Handler($profiles);
        });
        $this->app->instance('tideways','laravelTideways\Manager');
    }
    public function boot()
    {
        $this->configurePublishing();
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }
        $this->publishes([
            __DIR__.'/config/tideways.php' => config_path('tideways.php'),
        ], 'tideways-config');
    }
}