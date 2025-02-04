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

$routes->connect('/articles/delete/:slug', [
    'controller' => 'Articles',
    'action' => 'delete',
]);
