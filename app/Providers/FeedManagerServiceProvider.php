<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\FeedManager\FileCacheFeedManager;

class FeedManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\FeedManager\FeedFactoryInterface', 'App\FeedManager\BaseFeedFactory');

        $this->app->bind('App\FeedManager\FeedManagerInterface', function ($app) {
            return new FileCacheFeedManager($app['App\FeedManager\FeedManager'], $app['App\FeedManager\FeedFactoryInterface'], storage_path('framework/cache'));
        });
    }
}
