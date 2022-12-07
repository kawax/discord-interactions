<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Revolution\DiscordManager\Contracts\InteractionsResponse;
use Revolution\DiscordManager\Http\Response\ChannelMessageResponse;
use Revolution\DiscordManager\Http\Response\DeferredResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->singleton(InteractionsResponse::class, DeferredResponse::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
