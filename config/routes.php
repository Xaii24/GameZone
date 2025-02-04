<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    // Fallback route for the homepage, allowing dynamic control
    $builder->connect('/', [
        'controller' => 'Pages', // Use Pages controller (or your choice) for dynamic rendering
        'action' => 'display',
        'home', // This will match the 'home' view file inside Pages
    ]);

    // Custom routes
    $builder
        ->connect('/articles/delete/:slug', [
            'controller' => 'Articles',
            'action' => 'delete',
        ])
        ->setPass(['slug']);

    $builder
        ->connect('/articles/view/:slug', [
            'controller' => 'Articles',
            'action' => 'view',
        ])
        ->setPass(['slug']);

    $builder
        ->connect('/comments/view/:id', [
            'controller' => 'Comments',
            'action' => 'view',
        ])
        ->setPass(['id']);

    $builder
        ->connect('/comments/like/:id', [
            'controller' => 'CommentsLikes',
            'action' => 'add',
        ])
        ->setPass(['id']);

    // Fallback for other controllers
    $builder->fallbacks();
});
