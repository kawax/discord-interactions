<?php

use Discord\WebSockets\Event;
use Revolution\DiscordManager\Support\Intents;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'discord' => [
        'path'      => [
            'commands' => app_path('Discord/Commands'),
            'directs'  => app_path('Discord/Directs'),
            'interactions'  => app_path('Discord/Interactions'),
        ],

        //Bot token
        'token'     => env('DISCORD_BOT_TOKEN'),
        //APPLICATION ID
        'bot'       => env('DISCORD_BOT'),
        //PUBLIC KEY
        'public_key' => env('DISCORD_PUBLIC_KEY'),

        //Notification route
        'channel'   => env('DISCORD_CHANNEL'),

        //Interactions command
        'interactions' => [
            'path' => 'discord/webhook',
            'route' => 'discord.webhook',
            'middleware' => 'throttle',
        ],

        //Gateway command
        'discord-php' => [
            'disabledEvents' => [
                Event::TYPING_START,
            ],
            'intents' => array_sum(Intents::default()),
        ],
    ],

];
