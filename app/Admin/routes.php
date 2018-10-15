<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'DashController@index')
        ->name('cp.dashboard');

    $router->resource('brands', 'BrandController')
        ->names('cp.brands');

    $router->resource('wheels', 'WheelController')
        ->names('cp.wheels');

    $router->resource('styles', 'StyleController')
        ->names('cp.styles');

    // api
    $router->get('api/brands', 'ApiController@brands')
        ->name('cp.api.brands');

    $router->get('api/wheels', 'ApiController@wheels')
        ->name('cp.api.wheels');

    $router->get('api/collections', 'ApiController@collections')
        ->name('cp.api.collections');

});
