<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    $builder->connect('/', [
        'controller' => 'Pages',
        'action' => 'display',
        'login',
    ]);

    $routes->connect('/users/reset-password', [
        'controller' => 'Users',
        'action' => 'resetPassword',
    ]);
    $routes
        ->connect('/users/reset-password/:token', [
            'controller' => 'Users',
            'action' => 'resetPasswordConfirm',
        ])
        ->setPatterns(['token' => '[a-f0-9]{32}']);
    $builder->fallbacks();
});

$routes->connect('/articles/delete/:slug', [
    'controller' => 'Articles',
    'action' => 'delete',
]);
