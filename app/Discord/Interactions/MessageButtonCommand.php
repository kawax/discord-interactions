<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageButtonCommand
{
    /**
     * @var  string
     */
    public string $command = 'click_one';

    /**
     * @param  Request  $request
     *
     * @return void
     */
    public function __invoke(Request $request): void
    {
        $app_id = config('services.discord.bot');
        $token = $request->json('token');

        $data = [
            'content' => "Click!",
            'allowed_mentions' => ['parse' => ['users']],
        ];

        $response = Http::discord()->post("/webhooks/$app_id/$token", $data);

        info($response->json());
    }
}
