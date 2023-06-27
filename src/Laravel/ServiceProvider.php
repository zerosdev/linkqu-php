<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu\Laravel;

use ZerosDev\LinkQu\Client;
use ZerosDev\LinkQu\Constant;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client(function ($client) {
                $client->setMode(config('linkqu.mode'))
                    ->setClientId(config('linkqu.client_id'))
                    ->setClientSecret(config('linkqu.client_secret'))
                    ->setUsername(config('linkqu.username'))
                    ->setServerKey(config('linkqu.server_key'))
                    ->setPin(config('linkqu.pin'));
            });
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../laravel-config.php' => config_path('linkqu.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }
}
