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

    $builder->connect('/pages/*', [
        'controller' => 'Pages',
        'action' => 'display',
    ]);

    $builder->fallbacks();
});

// DebugKit route
$routes->plugin('DebugKit', ['path' => '/debug-kit'], function (
    RouteBuilder $routes
) {
    $routes->fallbacks();
});

$routes->connect('/articles/delete/:slug', [
    'controller' => 'Articles',
    'action' => 'delete',
]);
