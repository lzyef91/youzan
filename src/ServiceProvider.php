<?php

namespace Nldou\Youzan;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{
    /**
     * Boot the provider.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/Config' => config_path()], 'nldou-youzan-config');
        }
    }

    /**
     * Register the provider.
     */
    public function register()
    {
        $source = realpath(__DIR__.'/Config/youzan.php');
        $this->mergeConfigFrom($source, 'youzan');

        $clientId = config('youzan.client_id');
        $clientSecret = config('youzan.client_secret');
        $kdtId = config('youzan.kdt_id');
        $tokenClient = new Token($clientId, $clientSecret, $kdtId);

        $this->app->singleton(Youzan::class, function ($laravelApp) use ($clientId, $clientSecret, $tokenClient) {
            return new Youzan($clientId, $clientSecret, $tokenClient);
        });
        $this->app->alias(Youzan::class, 'youzan');
    }

    public function provides()
    {
        return [Youzan::class, 'youzan'];
    }
}
