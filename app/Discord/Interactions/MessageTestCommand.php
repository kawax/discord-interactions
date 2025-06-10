<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Revolution\DiscordManager\Concerns\WithInteraction;
use Revolution\DiscordManager\Support\ButtonStyle;
use Revolution\DiscordManager\Support\ComponentType;

class MessageTestCommand
{
    use WithInteraction;

    public string $command = 'message-test';

    public function __invoke(Request $request): void
    {
        $user = $request->json('member.user.id', $request->json('user.id'));

        $data = [
            'content' => "<@$user> message-test!",
            'allowed_mentions' => ['parse' => ['users']],
            'components' => [
                [
                    'type' => ComponentType::ACTION_ROW,
                    'components' => [
                        [
                            'type' => ComponentType::BUTTON,
                            'label' => 'Click me!',
                            'style' => ButtonStyle::LINK,
                            'url' => 'https://example.com/',
                        ],
                    ],
                ],
            ],
        ];

        $response = $this->followup(token: $request->json('token'), data: $data);

        info($response->json());
    }
}
