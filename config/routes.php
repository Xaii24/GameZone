<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    // Set homepage (Change if needed)
    $builder->connect('/', [
        'controller' => 'Articles',
        'action' => 'index',
    ]);

    // Pages routes
    $builder->connect('/pages/*', [
        'controller' => 'Pages',
        'action' => 'display',
    ]);

    // Articles routes
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

    // Comments routes
    $builder
        ->connect('/comments/view/:id', [
            'controller' => 'Comments',
            'action' => 'view',
        ])
        ->setPass(['id']);

    // Comment Likes Route
    $builder
        ->connect('/comments/like/:id', [
            'controller' => 'CommentLikes',
            'action' => 'add',
        ])
        ->setPass(['id']);

    // Fallback routes
    $builder->fallbacks();
});
