<?php

return [
    'networks' => [
        'xbl' => App\Http\Services\NetworkServices\XBLNetworkService::class,
        'steam' => App\Http\Services\NetworkServices\SteamNetworkService::class,
        'minecraft' => App\Http\Services\NetworkServices\MinecraftNetworkService::class,
        // One place to extend them all
    ],
];
