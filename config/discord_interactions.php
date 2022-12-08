<?php

use Revolution\DiscordManager\Support\CommandOptionType;
use Revolution\DiscordManager\Support\CommandType;

/**
 * Discord Interactions Commands.
 */
return [
    'guild' => [
        [
            'name' => 'test',
            'description' => 'test command',
            'type' => CommandType::CHAT_INPUT,
            'guild_id' => env('DISCORD_GUILD'),
            'options' => [
                [
                    'name' => 'message',
                    'description' => 'optional message',
                    'type' => CommandOptionType::STRING,
                ],
            ],
        ],
        [
            'name' => 'user-test',
            //'description' => 'user test command',
            'type' => CommandType::USER,
            'guild_id' => env('DISCORD_GUILD'),
        ],
        [
            'name' => 'message-test',
            //'description' => 'message test command',
            'type' => CommandType::MESSAGE,
            'guild_id' => env('DISCORD_GUILD'),
        ],
    ],
    'global' => [
        [
            'name' => 'hello',
            'description' => 'hello command',
            'type' => CommandType::CHAT_INPUT,
        ],
    ],
];
