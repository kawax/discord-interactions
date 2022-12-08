<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Revolution\DiscordManager\Support\ButtonStyle;
use Revolution\DiscordManager\Support\ComponentType;

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
            'components' => [
                [
                    'type' => ComponentType::ACTION_ROW,
                    'components' => [
                        [
                            "type" => ComponentType::BUTTON,
                            'label' => 'Click me!',
                            'style' => ButtonStyle::LINK,
                            'url' => 'https://example.com/',
                        ],
                    ],
                ],
            ],
        ];

        $response = Http::discord()->post("/webhooks/$app_id/$token", $data);

        info($response->json());
    }
}
