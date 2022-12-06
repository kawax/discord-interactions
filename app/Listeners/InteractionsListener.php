<?php

namespace App\Listeners;

use App\Events\InteractionsWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

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
        //
        dispatch(function () use ($event) {
            $app_id = config('services.discord.bot');
            $token = $event->request->json('token');

            $data = [
                'content' => '<@'.$event->request->json('member.user.id').'> Hello!',
                'allowed_mentions' => ['parse' => ['users']],
            ];

            $response = Http::discord()->post("/webhooks/$app_id/$token", $data);

            info($response->json());
        })->afterResponse();
    }
}
