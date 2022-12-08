<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Revolution\DiscordManager\Events\InteractionsWebhook;
use Revolution\DiscordManager\Facades\DiscordManager;

class InteractionsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InteractionsWebhook  $event
     * @return void
     */
    public function handle(InteractionsWebhook $event)
    {
        info($event->request->collect()->toJson(JSON_PRETTY_PRINT));

        // Must use queue or dispatch()->afterResponse()

        // When not using a queue
        dispatch(fn () => DiscordManager::interaction($event->request))->afterResponse();

        // When using a queue
        //DiscordManager::interaction($event->request);
    }
}
