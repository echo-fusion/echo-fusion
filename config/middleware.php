<?php

declare(strict_types=1);

use EchoFusion\AuthManager\Middleware\AuthenticateMiddleware;
use EchoFusion\AuthManager\Middleware\GuestMiddleware;
use EchoFusion\SessionManager\Middleware\StartSessionMiddleware;

return [
    // Run for every request, in this order. The first one wraps all the others.
    'core' => [
        StartSessionMiddleware::class,
    ],

    // Names you can use in a route: 'middlewares' => ['auth']
    'route' => [
        'auth' => AuthenticateMiddleware::class,
        'guest' => GuestMiddleware::class,
    ],
];
