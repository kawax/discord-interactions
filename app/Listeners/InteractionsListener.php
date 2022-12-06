<?php

namespace App\Listeners;

use App\Events\InteractionsWebhook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
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
        dispatch(function () use ($event) {
            $app_id = config('services.discord.bot');
            $token = $event->request->json('token');

            $data = [
                'content' => $this->content($event->request),
                'allowed_mentions' => ['parse' => ['users']],
            ];

            $response = Http::discord()->post("/webhooks/$app_id/$token", $data);

            info($response->json());
        })->afterResponse();
    }

    protected function content(Request $request): string
    {
        info($request->collect()->toJson());

        return match ($request->json('name')) {
            'test' => $this->test($request),
            'hello' => $this->hello($request),
            default => '<@'.$request->json('member.user.id').'> Hi!',
        };
    }

    protected function test(Request $request): string
    {
        $message = $request->collect('options')->firstWhere('name', 'message')['value'];

        if (blank($message)) {
            $message = 'test';
        }

        return '<@'.$request->json('member.user.id').'> '.$message.'!';
    }

    protected function hello(Request $request): string
    {
        $message = $request->collect('options')->firstWhere('name', 'message')['value'];

        if (blank($message)) {
            $message = 'Hello';
        }

        return '<@'.$request->json('member.user.id').'> '.$message.'!';
    }
}
