<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Revolution\DiscordManager\Concerns\WithInteraction;

class HelloCommand
{
    use WithInteraction;

    public string $command = 'hello';

    public function __invoke(Request $request): void
    {
        $user = $request->json('member.user.id', $request->json('user.id'));

        $data = [
            'content' => "<@$user> Hello!",
            'allowed_mentions' => ['parse' => ['users']],
        ];

        $response = $this->followup(token: $request->json('token'), data: $data);

        info($response->json());
    }
}
