<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;

/*
 * One entry per route: the key is the route's name.
 *   method        GET, POST, PUT, PATCH, DELETE or OPTIONS
 *   path          /posts/{id} or /posts/{id:\d+}; a placeholder becomes an argument of the action
 *   action        [Controller::class, 'method'] or a closure
 *   constraints   optional regex per placeholder: ['id' => '[0-9]+']; without one a placeholder matches letters, digits, _ and -
 *   middlewares   optional names from config/middleware.php: ['auth']
 *
 * Prefer code? Return a function instead: `return static function (RouteRegistrarInterface $router): void { ... };`
 */
return [
    'home' => ['method' => 'GET', 'path' => '/', 'action' => [HomeController::class, 'index']],
    'hello' => ['method' => 'GET', 'path' => '/hello/{name}', 'action' => [HomeController::class, 'hello'], 'constraints' => ['name' => '[^/]+']],
    'ping' => ['method' => 'GET', 'path' => '/api/ping', 'action' => [HomeController::class, 'ping']],
];
