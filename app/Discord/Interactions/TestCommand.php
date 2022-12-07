<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class TestCommand
{
    /**
     * @var  string
     */
    public string $command = 'test';

    /**
     * @param  Request  $request
     *
     * @return void
     */
    public function __invoke(Request $request): void
    {
        $app_id = config('services.discord.bot');
        $token = $request->json('token');

        $message = $request->collect('data.options')->firstWhere('name', 'message');

        $message = Arr::get($message, 'value', 'test');

        $user = $request->json('member.user.id', $request->json('user.id'));

        $data = [
            'content' => "<@$user> $message!",
            'allowed_mentions' => ['parse' => ['users']],
        ];

        $response = Http::discord()->post("/webhooks/$app_id/$token", $data);

        info($response->json());
    }
}
