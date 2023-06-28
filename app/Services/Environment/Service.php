<?php

namespace App\Services\Environment;

use App\Models\Legislature;
use App\Support\Constants;

class Service
{
    public function data()
    {
        return [
            'app' => [
                'name' => config('app.name'),
                'version' => '1.0', //Version::format('compact'),
            ],


            'broadcast' => [
                'driver' => config('broadcasting.default', 'pusher'),
            ],

            'pusher' => [
                'server' => config('broadcasting.connections.pusher.server'),

                'key' => config('broadcasting.connections.pusher.key'),

                'options' => [
                    'cluster' => config('broadcasting.connections.pusher.options.cluster', 'us2'),
                    'encrypted' => config(
                        'broadcasting.connections.pusher.options.encrypted',
                        false
                    ),
                    'host' => config(
                        'broadcasting.connections.pusher.options.backend_host',
                        '127.0.0.1'
                    ),
                    'port' => config('broadcasting.connections.pusher.options.port', '6001'),
                    'scheme' => config('broadcasting.connections.pusher.options.scheme', 'http'),
                ],
            ],
        ];
    }
}
