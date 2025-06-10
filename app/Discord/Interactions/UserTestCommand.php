<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Revolution\DiscordManager\Concerns\WithInteraction;
use Revolution\DiscordManager\Support\ButtonStyle;
use Revolution\DiscordManager\Support\ComponentType;

class UserTestCommand
{
    use WithInteraction;

    public string $command = 'user-test';

    public function __invoke(Request $request): void
    {
        $user = $request->json('member.user.id', $request->json('user.id'));

        $target_user = $request->collect('data.resolved.users')->keys()->first();

        $data = [
            'content' => "<@$user> user-test! <@$target_user>",
            'allowed_mentions' => ['parse' => ['users']],
            'components' => [
                [
                    'type' => ComponentType::ACTION_ROW,
                    'components' => [
                        [
                            'type' => ComponentType::BUTTON,
                            'label' => 'Click me!',
                            'style' => ButtonStyle::PRIMARY,
                            'custom_id' => 'click_one',
                        ],
                    ],
                ],
            ],
        ];

        $response = $this->followup(token: $request->json('token'), data: $data);

        info($response->json());
    }
}
