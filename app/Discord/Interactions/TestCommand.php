<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Revolution\DiscordManager\Concerns\WithInteraction;

class TestCommand
{
    use WithInteraction;

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
        $message = $request->collect('data.options')->firstWhere('name', 'message');

        $message = Arr::get($message, 'value', 'test');

        $user = $request->json('member.user.id', $request->json('user.id'));

        $data = [
            'content' => "<@$user> $message!",
            'allowed_mentions' => ['parse' => ['users']],
        ];

        $response = $this->followup(token: $request->json('token'), data: $data);

        info($response->json());
    }
}
