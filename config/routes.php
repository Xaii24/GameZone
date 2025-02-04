<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    // Add other routes here
    $builder->connect('/articles/delete/:slug', [
        'controller' => 'Articles',
        'action' => 'delete',
    ]);

    $builder
        ->connect('/comments/like/:id', [
            'controller' => 'CommentsLikes',
            'action' => 'add',
        ])
        ->setPass(['id']);

    $builder->connect('/articles/view/:slug', [
        'controller' => 'Articles',
        'action' => 'view',
    ]);

    $builder->connect('/comments/view/:id', [
        'controller' => 'Comments',
        'action' => 'view',
    ]);

    // Fallback route (default route for other controllers)
    $builder->fallbacks();
});
