<?php

namespace App\Discord\Interactions;

use Illuminate\Http\Request;
use Revolution\DiscordManager\Concerns\WithInteraction;

class ButtonClicked
{
    use WithInteraction;

    public string $command = 'click_one';

    public function __invoke(Request $request): void
    {
        $data = [
            'content' => 'Click!',
            'allowed_mentions' => ['parse' => ['users']],
        ];

        $response = $this->followup(token: $request->json('token'), data: $data);

        info($response->json());
    }
}
