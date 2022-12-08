<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageTestCommand
{
    /**
     * @var  string
     */
    public string $command = 'message-test';

    /**
     * @param  Request  $request
     *
     * @return void
     */
    public function __invoke(Request $request): void
    {
        $app_id = config('services.discord.bot');
        $token = $request->json('token');

        $user = $request->json('member.user.id', $request->json('user.id'));

        $data = [
            'content' => "<@$user> message-test!",
            'allowed_mentions' => ['parse' => ['users']],
            "components" => [
                [
                    "type" => 1,
                    "components" => [
                        [
                            "type" => 2,
                            "label" => "Click me!",
                            "style" => 1,
                            "custom_id" => "click_one",
                        ],
                    ],
                ],
            ],
        ];

        $response = Http::discord()->post("/webhooks/$app_id/$token", $data);

        info($response->json());
    }
}
