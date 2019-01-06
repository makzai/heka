<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
//    $router->get('view', 'ViewController@index');
    $router->resource('view', ViewController::class);
    $router->resource('album', AlbumController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('information', InformationController::class);

});
