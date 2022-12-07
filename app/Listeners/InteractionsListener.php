<?php

namespace App\Listeners;

use App\Events\InteractionsWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
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
        dispatch(function () use ($event) {
            DiscordManager::interaction($event->request);
        })->afterResponse();
    }

    protected function content(Request $request): string
    {
        return match ($request->json('data.name')) {
            'test' => $this->test($request),
            'hello' => $this->hello($request),
            default => '<@'.$request->json('member.user.id', $request->json('user.id')).'> Hi!',
        };
    }

    protected function test(Request $request): string
    {
        $message = $request->collect('data.options')->firstWhere('name', 'message');

        $message = Arr::get($message, 'value', 'test');

        $user = $request->json('member.user.id', $request->json('user.id'));

        return "<@$user> $message!";
    }

    protected function hello(Request $request): string
    {
        $message = $request->collect('data.options')->firstWhere('name', 'message');

        $message = Arr::get($message, 'value', 'Hello');

        $user = $request->json('member.user.id', $request->json('user.id'));

        return "<@$user> $message!";
    }
}
