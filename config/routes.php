<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    // Set the homepage to be handled by ArticlesController -> index
    $builder->connect('/', [
        'controller' => 'Pages', // Use Pages controller (or your choice) for dynamic rendering
        'action' => 'display',
        'home', // This will match the 'home' view file inside Pages
    ]);

    // Add other routes here
    $builder->connect('/articles/delete/:slug', [
        'controller' => 'Articles',
        'action' => 'delete',
    ]);

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
