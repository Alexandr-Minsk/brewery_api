<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\HttpClient;

class HttpClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HttpClient::class, function ($app) {
            return new HttpClient([
                'base_uri' => config('app.api_url')
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
