<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    // Force the homepage to go to UsersController->login
    $builder->connect('/', [
        'controller' => 'Users',
        'action' => 'login',
    ]);

    // Define other specific routes
    $builder
        ->connect('/articles/view/:slug', [
            'controller' => 'Articles',
            'action' => 'view',
        ])
        ->setPass(['slug']);

    $builder
        ->connect('/articles/delete/:slug', [
            'controller' => 'Articles',
            'action' => 'delete',
        ])
        ->setPass(['slug']);

    // If you want a logout route
    $builder->connect('/logout', [
        'controller' => 'Users',
        'action' => 'logout',
    ]);

    // Disable automatic fallback routing (so CakePHP doesn’t interfere)
    // Comment out this line if you want full manual control:
    // $builder->fallbacks();
});
